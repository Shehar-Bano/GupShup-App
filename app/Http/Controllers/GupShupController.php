<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class GupShupController extends Controller
{
    public function fireMessage(Request $request){
        MessageSent::dispatch($request->sender, $request->message);
        return $request->all();
    }
    public function chatroom(Request $request){
        $request->validate(['username'=>'required']);
        $username = $request->username;
        return view('chat_room',['username' =>$username]);

    }

}
