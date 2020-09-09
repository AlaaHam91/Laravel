<?php

namespace App;
use Laravel\Socialite\Contracts\User as ProvidedUeser;
use App\SocialAccount;
use Illuminate\Database\Eloquent\Model;


class SocialAccountService{

    public function findorCreate(ProvidedUeser $providedUeser,$provider)
    {
        //search to the account by Id for the requested provider
        $account=SocialAccount::where('provider_id',$providedUeser->getId())->where('provider_name',$provider)->first();
        //the account exist return the user
        if($account)
        {
            return $account->user();
        }
        //the account does not exist search to the user by email
        else
        {
            $user=User::where('email',$providedUeser->getEmail())->first();
            //user not exist create it and create new account for it
            if(!$user)
            {
                $user=User::create(['email'=>$providedUeser->getEmail(),'name'=>$providedUeser->getName()]);
            }
                $user->accounts()->create(['provider_id'=>$providedUeser->getId(),'provider_name'=>$provider]);
            return $user;
        }

    }


}
