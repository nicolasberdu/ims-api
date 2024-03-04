<?php

namespace App\Handlers\AuthHandlers;

use App\Models\User;
use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;

class RegisterUserHandler extends AbstractHandler
{
    public function handle(object $request): object {
        try {
            $user = User::create($request->safe()->only(['name', 'email', 'password']));
            return Response::json('Usuario ' . $user->email . ' registrado', 201);
        } catch (QueryException $e) {

            Log::error($e);
            return Response::json([
                'error' => 'Error interno del servidor'
            ], 500); 
        }   
    }
}