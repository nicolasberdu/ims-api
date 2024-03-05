<?php

namespace App\Handlers\ProductHandlers;

use App\Handlers\AbstractHandler;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class StoreProductHandler extends AbstractHandler {

    public function handle(object $request): object {

        try {
            Product::create(
                $request->safe()->only([
                    'code',
                    'product_name',
                    'description',
                    'category_code',
                    'price',
                    'is_enabled'
            ]));

            return response()->json('Recurso creado exitosamente', 201);
        } catch (QueryException $e) {
            Log::error($e);
            return response()->json($e->getMessage(), 500);
            return response()->json('Error de servidor interno', 500);
        }
    }
}