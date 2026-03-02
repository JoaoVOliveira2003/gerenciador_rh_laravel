<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ConfirmAccontController extends Controller
{
    public function ConfirmAccont($token){
        $user = User::where('confirmation_token',$token)->first();
        if(!$user){
            abort('403','Token invalido');
        }
         return view('mail.confirm-account',compact('user'));
    }

    public function confirmarConta(Request $request){
        $request->validate([
            'token'=>'required|string',
            'password'=>'required|confirmed',
        ]);

        $user = User::where('confirmation_token',$request->token)->first();
        $user->password = bcrypt($request->password);
        $user->confirmation_token=null;
        $user->email_verified_at=now();
        $user->save();

        return view('auth.welcome')->with('user',$user);
    }
}

// 3ojoao953@gmail.com
// 3senha
