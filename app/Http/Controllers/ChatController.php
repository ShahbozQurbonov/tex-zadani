<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->chats);
    }

    public function create(Request $request)
    {
        $chat = Chat::create([
            'type' => $request->type,
            'created_by' => $request->user()->id,
        ]);

        return response()->json($chat, 201);
    }

    public function show($id)
    {
        $chat = Chat::findOrFail($id);
        return response()->json($chat->messages);
    }

}
