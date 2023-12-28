<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'nullable|string',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'password' => 'required|min:6',
            'user_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 405);
        }

        $user = new User;
        $user->full_name = $request->full_name;
        $user->store_name = $request->store_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->user_type = $request->user_type;
        $user->balance = "0";
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('MyApp')->plainTextToken;
        
        return response()->json(['user' => $user, 'token' => $token], 200);
    }        

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token], 200);
        }

        return response()->json(['error' => 'Invalid User'], 402);
    }
}
