<?php

namespace App\Http\Controllers\Frontend;

use App\Components\Facades\UserAccountFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\Account;
use App\Models\Entities\AccountProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['edit', 'update', 'show']]);
    }

    public function confirm($token)
    {
        $model = Account::where('registration_token', $token)->firstOrFail();
        $facade = new UserAccountFacade($model);
        $facade->activate();
        Auth::loginUsingId($model->id);
        return redirect()->route('frontend.index')->with('success', trans('account.activated'));
    }

    public function create()
    {
        $account = new Account();
        $profile = new AccountProfile();
        return view('frontend.account.create', ['account' => $account, 'profile' => $profile]);
    }

    public function store(Request $request)
    {
        $facade = new UserAccountFacade(
            new Account(),
            new AccountProfile()
        );
        $validate = $facade->getValidationRequirements($request->all());
        if ($validate) {
            $this->validate($request, $validate);
        }
        if ($facade->save()) {
            $type = 'success';
            $message = trans('account.confirmation_required');
        } else {
            $type = 'error';
            $message = trans('unknown.error');
        }
        return redirect()->route('frontend.index')->with($type, $message);
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);
        $profile = $account->profile;
        return view('frontend.account.show', ['account' => $account, 'profile' => $profile]);
    }

    public function edit()
    {
        $account = Auth::user();
        $this->authorize('update-own-profile', $account->profile);
        return view('frontend.account.update', ['account' => $account, 'profile' => $account->profile]);
    }

    public function update(Request $request)
    {
        $facade = new UserAccountFacade($request->user());
        $profile = $facade->getProfile();
        $this->authorize('update-own-profile', $profile);
        $validate = $facade->getValidationRequirements($request->all());
        if ($validate) {
            $this->validate($request, $validate);
        }
        $avatar = $request->file('avatar');
        if ($avatar) {
            $profile->assignImageToAttribute('avatar_url', ['file' => $avatar]);
            $profile->setImageSizes('preview', 300);
            $profile->saveImages();
        }
        $facade->update();
        return redirect()->route('frontend.account.edit')->with('success', trans('account.profile_updated'));
    }
}
