<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
