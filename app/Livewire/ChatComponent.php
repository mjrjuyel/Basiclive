<?php

namespace App\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Message;
use App\Models\User;
use App\Events\sendMesageEvent;
use Carbon\Carbon;

class ChatComponent extends Component
{
    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount($userId){
        $this->user = User::where('id',$userId)->first();
        // dd($this->user);
        $this->sender_id = Auth::user()->id;
        $this->receiver_id = $userId;

        $messages = Message::where(function($query){
            $query->where('sender_id',$this->sender_id)->where('receiver_id',$this->receiver_id);
        })->orWhere(function($query){
            $query->where('sender_id',$this->receiver_id)->where('receiver_id',$this->sender_id);
        })->with('sender:id,name','receiver:id,name')->get();

        foreach($messages as $message){
            $this->chatMessage($message);
        }
    }

    public function sendMessage(){
        $insert = Message::create([
            'message'=>$this->message,
            'sender_id'=>$this->sender_id,
            'receiver_id'=>$this->receiver_id,
            'created_at'=>Carbon::now(),
        ]);
        broadcast(new sendMesageEvent($insert))->toOthers();

        $this->message ='';
    }

    #[on('echo-private:chat-channel.{sender_id},sendMesageEvent')]

    public function listenForMessage($event){
        dd($event);
    }

    public function chatMessage($message){
        $this->messages[] = [
            'id' => $message['id'],
            'message' => $message['message'],
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name,
            'created_at'=>$message['created_at'],
        ];
        // dd($this->messages);
    }
}
