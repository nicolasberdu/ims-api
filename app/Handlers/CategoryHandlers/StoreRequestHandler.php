<?php

namespace App\Handlers\CategoryHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StoreRequestHandler extends AbstractHandler {

    protected $messages = [
        'code.required' => 'El campo code es obligatorio',
        'code.string' => 'El campo code debe ser de tipo string',
        'code.unique' => 'El codigo ya se encuentra registrado',
        'category.required' => 'El campo category es obligatorio',
        'category.string' => 'El campo category debe ser de tipo string',
        'category.unique' => 'La categoria ya se encuentra registrada',
        'description' => 'La descripcion debe ser de tipo string',
    ];

    protected $rules = [
        'code' => 'required|string|unique:categories,code',
        'category' => 'required|string|unique:categories,category',
        'description' => 'string',
    ];

    public function handle(object $request): object {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if(!$validator->fails()){
            return parent::handle($validator);
        } else {
            return Response::json($validator->errors(), 400);
        }
    }
}