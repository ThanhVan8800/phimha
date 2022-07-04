<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ThankMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendMailcontroller extends Controller
{
    public function sendMail(Request $request)
    {
        $user = User::find(1);
        $mailable = new ThankMail($user);
        Mail::to("0306191076@caothang.edu.vn")
        // ->cc(''); gui cho nguoi khac
        ->queue($mailable);
        return true;
    }
}
