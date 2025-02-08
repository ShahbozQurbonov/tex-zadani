<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        return response()->json($chat->messages);
    }
    public function store(Request $request, $chatId)
    {
        $chat = Chat::findOrFail($chatId);

        $message = Message::create([
            'chat_id' => $chatId,
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'file_url' => $request->file_url
        ]);
        return response()->json($message, 201);
    }
}
