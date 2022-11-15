<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Str;

class MailController extends Controller
{

    public static function VerificationEmail($name,$email,$verification_code)
    {
        $data =[
            'name'=>$name,
            'email'=>$email,
            'verification_code'=> Str::random(10),
        ];

        Mail::to($email)->send(new VerificationEmail($data));
        return $data['verification_code'];
    }

    
}