<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageNotificationController extends Controller
{
    public function message() {

        $messageNotf = [];

        foreach(auth()->user()->unreadNotifications as $notf) {

            if($notf->type == 'App\Notifications\MessageNotification') {

                array_push($messageNotf, $notf);

            }

        }

        return response()->json($messageNotf);

    }
}
