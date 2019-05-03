<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestMailController extends Controller
{
    public function send()
    {
        Mail::to('mh52124@gmail.com')
            ->send(new TestMail());
    }
}
