<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class APIAuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * 
     * @return [type]
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->input('email'))->first();
        if (Auth::attempt($credentials)) {
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                'status' => 'Login successful',
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
