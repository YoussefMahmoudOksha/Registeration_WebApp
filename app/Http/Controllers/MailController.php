<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\reguser;

class MailController extends Controller
{

    public function sendEmail(reguser $user)
    {
        try {
            Mail::to('laravele6@gmail.com')->send(new MailNotify($user));
            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error while sending email'], 500);
        }
    }
}
