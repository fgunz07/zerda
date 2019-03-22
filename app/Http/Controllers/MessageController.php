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

        $notifications = auth()->user()->unreadNotifications;

        // mark all notifications as read
        foreach($notifications as $notf) {

            $notf->markAsRead();

        }

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

    public function getMessage(Request $request , $id) {

        if($request->has('notf_msg')) {

            auth()->user()->unreadNotifications->where('id', $request->notf_msg)->markAsRead();
        
        }

        // get message and mark as read because it's already viewed
        $message = Message::find($id);
        $message->read = 1;
        $message->save();

        return view('pages.message.message')
                    ->with('message' , $message);

    }

    public function getUnreadMessages() {

        $messages = auth()->user()->getMessageFrom;

        $unread    = null;

        if(!is_null($messages)){
            
            // count all messages where not mark as read
            foreach($messages as $msg) {

                if($msg->read != 1) {
                    $unread += 1;
                }

            }

        }

        return response()->json(['messages' => $messages , 'unread' => $unread]);

    }

    public function saveDraft(Request $request) {

        $user = User::where('email', $request->to)->first();

        if($request->has('to')) {

        //     $user = User::where('email', $request->to)->first();

            if(is_null($user)) {

                return response()->json(['message' => 'This user does not exist'], 404);

            }

        }

        $message                = new Message;
        $message->message_html  = $request->html;
        $message->message_text  = $request->text;
        $message->subject       = $request->sub;
        $message->to            = $user->id;
        $message->draft         = 1;
        $message->read          = 0;
        $message->from          = auth()->user()->id;
        $message->save();

        return response()->json(['message' => 'Message save on draft.']);

    }

    public function sent() {
        return view('pages.message.sent');
    }

    public function sentMessages() {
        $messages = auth()->user()->getSentMessages;

        $unread    = null;

        if(!is_null($messages)){
            
            // count all messages where not mark as read
            foreach($messages as $msg) {

                if($msg->read !== 1) {
                    $unread += 1;
                }

            }

        }

        return response()->json(['messages' => $messages , 'unread' => $unread]);
    }

    public function showDraft() 
    {

        return view('pages.message.draft');

    }

    public function getDraft($id) 
    {

        $message = Message::find($id);

        return view('pages.message.compose')
                ->with('data', $message);
    }

    public function delete(Request $data) {
        try {
            foreach($data->ids as $id) {
                Message::find($id)->delete();
            }
        } catch(Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
        return response()->json([], 200);
    }

    public function trash() {
        return view('pages.message.trash')
                ->with('trash', auth()->user()->getTrash);
    }

    public function clearTrash(Request $data) {
        try {
            foreach($data->ids as $id) {
                Message::withTrashed()->where('id', $id)->forceDelete();
            }
        } catch(Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
        return response()->json([], 200);
    }

}
