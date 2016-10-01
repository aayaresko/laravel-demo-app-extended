<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

namespace App\Http\Controllers\Auth;

use App\Components\Facades\UserAccountFacade;
use App\Models\Entities\Account;
use App\Models\Entities\AccountProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    /**
     * Perform OAuth2 request.
     *
     * Specified scope instructs facebook grant an access to user profile data and email.
     *
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->scopes(['public_profile', 'email', 'user_birthday'])->redirect();
    }

    /**
     * Handle provider callback.
     *
     * If user does not exist - creates a new user and stores that user in the local storage.
     * Authenticates user automatically and redirects him to the homepage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        $container = Socialite::driver('facebook')->user();
        $account = Account::where('email', $container->getEmail())->first();
        if (!$account) {
            $profile = new AccountProfile();
            $profile->full_name = $container->getName();
            $data = [
                'email' => $container->getEmail(),
            ];
            if (isset($container->user['birthday'])) {
                $data['birth_date'] = $container->user['birthday'];
            }
            $facade = new UserAccountFacade(new Account(), $profile);
            $facade->send_email = false;
            $facade->save($data);
            $facade->activate();
            $account = $facade->getAccount();
        }
        Auth::login($account);
        return redirect('/');
    }
}
