<?php

namespace App\Handlers\ProductHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StoreRequestHandler extends AbstractHandler {

    protected $messages = [
        'code.required' => 'El campo code es obligatorio',
        'code.string' => 'El campo code debe ser de tipo entero',
        'code.unique' => 'El codigo ya se encuentra registrado',
        'product_name.required' => 'El campo product_name es obligatorio',
        'product_name.string' => 'El campo product_name debe ser de tipo string',
        'product_name.unique' => 'El producto ya se encuentra registrado',
        'description' => 'La descripcion debe ser de tipo string',
        'category_code.string' => 'El campo category_code debe ser de tipo string',
        'category_code.exists' => 'El codigo de categoria no existe',
        'price' => 'El campo price debe ser de tipo decimal',
        'is_enabled' => 'El campo is_enabled debe ser de tipo booleano',
    ];

    protected $rules = [
        'code' => 'required|integer|unique:products,code',
        'product_name' => 'required|string|unique:products,product_name',
        'description' => 'string',
        'category_code' => 'string|exists:categories,code',
        'price' => 'decimal:2',
        'is_enabled' => 'bool',
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