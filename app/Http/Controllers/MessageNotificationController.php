<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageNotificationController extends Controller
{
    public function message() {

        dd(auth()->user()->notifications);

    }
}
