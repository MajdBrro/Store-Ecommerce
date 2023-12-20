<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Services\VerificationServices;

class VerificationCodeController extends Controller
{

    public $verificationService;
    public function __construct(VerificationServices $verificationService)
    {
        $this -> verificationService = $verificationService;
    }

    public function GetVerifyPage(){
        return view('auth.verification');
    }


    public function verify(VerificationRequest $request)
    {
        $check = $this ->  verificationService -> checkOTPCode($request -> code);
        if(!$check){  // code not correct
          //  return 'you enter wrong code ';
            return redirect() -> route('get.verification.form')-> withErrors(['code' => 'ألكود الذي ادخلته غير صحيح ']);
        }else {  // verifiction code correct
            $this ->  verificationService -> removeOTPCode($request -> code);
            return redirect()->route('home');
        }
    }
}
