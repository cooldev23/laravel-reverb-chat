<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'text'
    ];

    /**
     * A message belongs to the sender.
     *
     * @return void
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * A message belongs to the receiver.
     *
     * @return void
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
