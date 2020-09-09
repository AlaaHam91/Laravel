<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        $v=Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|confirmed|min:6'

        ]);
        if($v->fails())
        //validation error
        {
            return response()->json([
                "status"=>"error",
                "errors"=>$v->errors()
            ],422);
        }
        $user=new User([
            "email"=>$request->email,
            "name"=>$request->name,

            "password"=>Hash::make($request->password)
        ]);
        $user->save();
        return response()->json(["mesage"=>"user created successfuly"],201);
    }

//login and create token
    public function login(Request $request)
    {

        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string',
            'remember_me'=>'bollean'
        ]);

        $credentials=$request->only("email","password");
        if($token=$this->guard()->attempt($credentials))
        {
            return $this->respondWithToken($token);
        }
        return response()->json(["error"=>"Your Email/Password is wrong"],401);
        }
    private function guard()
    {
        //it will return api
       return Auth::guard();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }

    public function user(Request $request)
    {
         $user = User::find(Auth::user()->id);
        // $user = User::find(2);
       // dd($user);
        return response()->json(['data' => $user]);
    }

    public function allNotifications()
    {
         $user = User::find(Auth::user()->id);

         $notifications=$user->notifications;
         foreach ($notifications as $notification) {
          $data_notifications[] = $notification->data;
      }
        return response()->json(['data' => $data_notifications]);
    }

    //logout

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(
            ["status"=>"success","msg"=>"logout successfuly"],200);
    }
}
