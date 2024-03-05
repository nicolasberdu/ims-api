<?php

namespace App\Handlers\ProductHandlers;

use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class IndexFindListHandler extends AbstractHandler
{
    public function handle(object $request): object {
        try {
            $products = Product::where('code', 'REGEXP', $request->get('search', '.*'))
                ->orWhere('product_name', 'REGEXP', $request->get('search', '.*'))
                ->orWhere('description', 'REGEXP', $request->get('search', '.*'))
                ->paginate($request->get('per_page', 10))->withQueryString();

            $data = [
                'count' => $products->count(),
                'next' => $products->nextPageUrl(),
                'previous' => $products->previousPageUrl(),
                'results' => ProductResource::collection($products),
            ];
            
            return Response::json($data, 200);
        } catch (QueryException $e) {
            Log::error($e);
            return Response::json([
                'error' => 'Error interno del servidor'
            ], 500); 
        }   
    }
}