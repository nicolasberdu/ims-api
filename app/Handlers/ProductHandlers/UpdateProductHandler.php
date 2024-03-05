<?php

namespace App\Handlers\ProductHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class UpdateProductHandler extends AbstractHandler {

    public function handle(object $request): object {
        try {
            $product = $request['product'];
            $product->update(
                $request['validator']->safe()->only([
                    'code',
                    'product_name',
                    'description',
                    'category_code',
                    'price',
                    'is_enabled'
            ]));

            return response()->json($product, 200);
        } catch (QueryException $e) {
            Log::error($e);
            return response()->json($e->getMessage(), 500);
            return response()->json('Error de servidor interno', 500);
        }
    }
}