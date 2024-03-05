<?php

namespace App\Handlers\CategoryHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UpdateRequestHandler extends AbstractHandler {

    protected $messages = [
        'code.string' => 'El campo code debe ser de tipo string',
        'code.unique' => 'El codigo ya se encuentra registrado',
        'category.string' => 'El campo category debe ser de tipo string',
        'category.unique' => 'La categoria ya se encuentra registrada',
        'description' => 'La descripcion debe ser de tipo string',
    ];

    protected $rules = [
        'code' => 'string|unique:categories,code',
        'category' => 'string|unique:categories,category',
        'description' => 'string',
    ];

    public function handle(object $request): object {
        $validator = Validator::make($request['request']->all(), $this->rules, $this->messages);

        if(!$validator->fails()){
            return parent::handle(collect(['validator' => $validator, 'category' => $request['category']]));
        } else {
            return Response::json($validator->errors(), 400);
        }
    }
}