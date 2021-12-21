<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail($id, $name, $email)
    {
        $data = [
            'id' => $id,
            'email' => $email,
            'name' => $name,
        ];
        Mail::to($email)->send(new RegisterEmail($data));
    }
}