<?php

namespace App\Http\Services;

use Hash;
use App\User;
use Illuminate\Support\Str;
use App\Mail\SendVerificationCode;
use Illuminate\Support\Facades\Mail;

class RegisterService
{
    public function register($request)
    {
        $v_code = Str::random(10);
	    $user = new User;
	    $user->name = $request->name;
	    $user->surname = $request->last_name;
	    $user->email = $request->email;
	    $user->phone = $request->phone;
	    $user->password = Hash::make($request->password);
	    $user->address = $request->adderss;
	    $user->is_admin = 1;
	    $user->code = $request->code;
	    $user->pvm_code = $request->pvm_code;
	    $user->verification_code = $v_code;
	    $user->save();

	    $email = \Illuminate\Support\Facades\Crypt::encrypt($request->email);
	    Mail::send( new SendVerificationCode($user,$v_code));
	    $url = route('register.verification').'/'.$email;
        return $url;
    }
}