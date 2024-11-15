<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function index(){
        $user = User::where('id','!=',auth()->user()->id)->latest('id')->get();
        // return $user;
        return view('chat.chatlist',compact('user'));
    }
    public function chat($id){
        $id=User::where('id',$id)->first();
        return view('chat.chat',compact('id'));
    }
}
