<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\InviteDev;
use App\User;
use App\Board;

class InviteNotificationController extends Controller
{
    public function inviteDev(Request $request)
    {

        try {

            $user   = User::find($request->target_user);
            $board  = Board::find($request->target_board); 

            $details = [
                'from'      => auth()->user()->id,
                'message'   => auth()->user()->email.' invites you on his project ' . $board->title . '.',
                'board_url' => "http://{$request->getHttpHost()}/todo-app/board-details/{$board->id}"
            ];

            $user->notify(new InviteDev($details));

        } catch(Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true, 'message' => "Invitation for {$user->email} send successfully."], 200);

    }

    public function getInviteNotifications(Request $request) 
    {

        $inviteNotf = [];

        foreach(auth()->user()->unreadNotifications as $notf) {

            if($notf->type = 'App\Notifications\InviteDev') {

                array_push($inviteNotf, $notf);

            }

        }

        return response()->json($inviteNotf);

    }
}
