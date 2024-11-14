<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function index(){
        $user = User::where('id','!=',auth()->user()->id)->latest('id')->get();
        return $user;
    }
}
