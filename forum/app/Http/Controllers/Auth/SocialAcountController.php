<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Socialite;
use App\SocialAccountService;


class SocialAcountController extends Controller
{
    //
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback(SocialAccountService $profileService,$provider)
    {
        try {

            $user = Socialite::driver($provider)->user();
           // dd($user->getID());
        } catch (Exception $e) {

            return redirect()->to('login');

        }

        // $user->token;

        $authUser=$profileService->findorCreate($user,$provider);
        auth()->login($authUser,true);
        return redirect()->to('/');
    }
}
