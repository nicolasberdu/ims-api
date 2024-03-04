<?php

namespace App\Handlers\AuthHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class RegisterRequestHandler extends AbstractHandler
{
    protected $messages = [
        'name.required' => 'El campo name es requirido',
        'name.string' => 'El campo name debe ser string',
        'name.max' => 'El campo name permite un maximo de 255 caracteres',

        'email.required' => 'El campo email es requirido',
        'email.email' => 'El campo email debe ser un correo electronico valido',
        'email.unique' => 'El email ya se encuentra registrado',

        'password.required' => 'El campo password es requirido',
        'password.string' => 'El campo password debe ser string',
        'password.min' => 'El campo password permite debe ser de almenos :min caracteres',
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8'
    ];


    public function handle(object $request): object {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if (!$validator->fails()) {
            return parent::handle($validator);
        } else {
            return Response::json($validator->errors(), 400);
        }
    }
}