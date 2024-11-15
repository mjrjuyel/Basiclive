<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $cats = [
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
    ];

    public function sender(){
        $this->belongsTo(User::class,'sender_id');
    } 

    public function receiver(){
        $this->belongsTo(User::class,'receiver_id');
    } 
}
