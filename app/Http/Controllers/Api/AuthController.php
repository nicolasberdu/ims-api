<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Handlers\AuthHandlers\RegisterRequestHandler;
use App\Handlers\AuthHandlers\RegisterUserHandler;

class AuthController extends Controller
{
    public function register(Request $request)   {

        $registerRequestHandler = new RegisterRequestHandler();
        $registerUserHandler = new RegisterUserHandler();

        $registerRequestHandler->setNext($registerUserHandler);
        
        return $registerRequestHandler->handle($request);
    }

    public function login (Request $request) {

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'User password invalidos'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function loguot(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Usuario deslogueado']);
    }

    public function userinfo(Request $request){
        return $request->user();
    }
}
