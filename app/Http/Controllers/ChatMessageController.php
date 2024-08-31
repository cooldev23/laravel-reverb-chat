<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index(User $receiver) {
        return inertia('Chat', [
            'receiver' => $receiver,
            'previousMessages' => ChatMessage::where([
                            ['sender_id', auth()->id()],
                            ['receiver_id', $receiver->id]
                        ])
                        ->orWhere([
                            ['sender_id', $receiver],
                            ['receiver_id', auth()->id()]
                        ])
                        ->with(['sender', 'receiver'])
                        ->orderBy('id', 'asc')
                        ->get()
        ]);
    }
}
