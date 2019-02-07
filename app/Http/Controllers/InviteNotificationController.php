<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\InviteDeveloper;
use App\User;

class InviteNotificationController extends Controller
{
    public function inviteDev(Request $request)
    {

        $details = [
            'from'      => auth()->user()->id,
            'message'   => auth()->user()->email.' invites you on his project.',
            'board'     => $request->getHttpHost().'/boards\/1'
        ];

        $user = User::find(1);
        $user->availabity = 1;
        $user->save();

        $user->notify(new InviteDeveloper($details));
        
    }
}
