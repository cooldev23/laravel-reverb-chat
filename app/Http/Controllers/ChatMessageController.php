<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\MessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ChatMessageController extends Controller
{
    public function index(User $receiver) {
        // dd($receiver);
        return inertia('Chat', [
            'receiver' => $receiver,
            'messages' => ChatMessage::where([
                            ['sender_id', auth()->id()],
                            ['receiver_id', $receiver->id]
                        ])
                        ->orWhere(function (Builder $query) use ($receiver) {
                            $query->where('receiver_id', auth()->id())
                                ->where('sender_id', $receiver->id);
                        })
                        ->with(['sender', 'receiver'])
                        ->orderBy('id', 'asc')
                        ->get()
        ]);
    }

    public function store(Request $request, User $receiver)
    {
        $chatMessage = ChatMessage::create([
            'sender_id' => $request->senderId,
            'receiver_id' => $request->receiverId,
            'text' => $request->message
        ]);

        broadcast(new MessageSent($chatMessage));

        return to_route('chat', [
            'receiver' => $receiver
        ]);
    }
}
