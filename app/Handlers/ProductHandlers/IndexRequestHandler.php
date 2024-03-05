<?php

namespace App\Handlers\ProductHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class IndexRequestHandler extends AbstractHandler {

    protected $messages = [
        'per_page' => 'El campo per_page debe ser de tipo entero',
    ];

    protected $rules = [
        'per_page' => 'integer',
        'search' => 'string'
    ];

    public function handle(object $request): object {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if(!$validator->fails()){
            return parent::handle($request);
        } else {
            return Response::json($validator->errors(), 400);
        }
    }
}