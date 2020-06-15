<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'messages', 'receiver_id', 'user_id', 'is_read',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
