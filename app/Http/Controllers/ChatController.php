<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
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
        return response()->json($chat);
    }
}
