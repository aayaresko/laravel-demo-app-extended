<?php

namespace App\Http\Controllers\Backend;

use App\Components\Facades\TablesFacade;
use App\Components\Facades\UserAccountFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\Account;
use App\Models\Entities\AccountProfile;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $models = Account::paginate(6);
        $table = new TablesFacade($models, ['nickname', 'email', 'profile.full_name', 'created'], 'backend.account');
        return view('backend.account.index', ['table' => $table]);
    }

    public function create()
    {
        $model = new Account();
        $profile = new AccountProfile();
        return view('backend.account.create', ['account' => $model, 'profile' => $profile]);
    }

    public function store(Request $request)
    {
        $facade = new UserAccountFacade(
            new Account(),
            new AccountProfile()
        );
        $facade->send_email = false;
        $validate = $facade->getValidationRequirements($request->all());
        if ($validate) {
            $this->validate($request, $validate);
        }
        $facade->save();
        return redirect()->route('frontend.account.index')->with('success', trans('models.saved'));
    }

    public function show($id)
    {
        $model = Account::findOrFail($id);
        $profile = $model->profile;
        return view('backend.account.show', ['account' => $model, 'profile' => $profile]);
    }

    public function edit($id)
    {
        $model = Account::findOrFail($id);
        $profile = $model->profile;
        return view('backend.account.update', ['account' => $model, 'profile' => $profile]);
    }

    public function update(Request $request, $id)
    {
        $facade = new UserAccountFacade(Account::findOrFail($id));
        $profile = $facade->getProfile();
        $validate = $facade->getValidationRequirements($request->all());
        if ($validate) {
            $this->validate($request, $validate);
        }
        $avatar = $request->file('avatar');
        if ($avatar) {
            $profile->assignImageToAttribute('avatar_url', ['file' => $avatar]);
            $profile->saveImages();
        }
        $facade->update();
        return redirect()->route('backend.account.edit', $facade->getAccount()->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = Account::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.account.index')->with('success', trans('models.deleted'));
        }
    }
}
