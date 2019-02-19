<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Notifications\MessageNotification;

class MessageController extends Controller
{

    public function __contruct() {

        view()->share('page_title', 'Message');

    }
    
    public function inbox() {

        view()->share('page_sub', 'Inbox');

        return view('pages.message.inbox');

    }

    public function compose() {

        view()->share('page_sub', 'Inbox');

        return view('pages.message.compose');

    }

    public function sendMessage(Request $request) {

        $message = null;

        try {

            $user = User::where('email', $request->to)->first();

            if(is_null($user)) {

                return response()->json(['message' => 'This user does not exist'], 404);

            }

            $message                = new Message;
            $message->message_html  = $request->html;
            $message->message_text  = $request->text;
            $message->subject       = $request->sub;
            $message->to            = $user->id;
            $message->from          = auth()->user()->id;
            $message->save();

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);

        }

        $details = [
            'notif'     => 'New message message notification.',
            'subject'   => $request->sub,
            'message_url'=> url('/messages/inbox/'.$message->id),
            'from'      => auth()->user()->email
        ];

        $user->notify(new MessageNotification($details));

        return response()->json(['message' => 'Message sent.'], 200);

    }

    public function getMessage($id) {

        $message = Message::find($id);

        return response()->json($message);

    }

    public function getUnreadMessages() {

        $messages = auth()->user()->getMessageFrom;

        return response()->json($messages);

    }

}
