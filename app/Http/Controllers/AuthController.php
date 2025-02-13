<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations\Post;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable|string|url'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar
        ]);

        $token = $user->createToken('chat-app')->accessToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('login', $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('chat-app')->accessToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function getUser(Request $request)
    {
        $user = User::all();
        if ($user->isEmpty()) {
            return response()->json(['message' => 'No users found'], 404);
        }
        return response()->json($user);
    }


    public function getUserSearch($search)
    {
        $user = User::where('id', $search)
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->orWhere('patronymic', 'LIKE', "%{$search}%")
            ->orWhere('login', 'LIKE', "%{$search}%")
            ->orWhere('avatar', 'LIKE', "%{$search}%")
            ->orWhere('created_at', 'LIKE', "%{$search}%")
            ->get();

        if ($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'Not found'], 404);
    }


    public function updateUser(Request $request)
    {
        $user = $request->user();
        $user->name = $request->input('name', $user->name);
        $user->surname = $request->input('surname', $user->surname);
        $user->patronymic = $request->input('patronymic', $user->patronymic);
        $user->avatar = $request->input('avatar', $user->avatar);
        $user->save();

        return response()->json($user);
    }
}
