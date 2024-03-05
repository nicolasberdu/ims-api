<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Database\QueryException;
use App\Handlers\ProductHandlers\IndexRequestHandler;
use App\Handlers\ProductHandlers\StoreProductHandler;
use App\Handlers\ProductHandlers\StoreRequestHandler;
use App\Handlers\ProductHandlers\IndexFindListHandler;
use App\Handlers\ProductHandlers\UpdateProductHandler;
use App\Handlers\ProductHandlers\UpdateRequestHandler;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $requestHandler = new IndexRequestHandler();
        $findListHandler = new IndexFindListHandler();

        $requestHandler->setNext($findListHandler);
        return $requestHandler->handle($request);
    }

    public function store(Request $request)
    {
        $requestHandler = new StoreRequestHandler();
        $storeProductHandler = new StoreProductHandler();

        $requestHandler->setNext($storeProductHandler);
        return $requestHandler->handle($request);
    }

    public function show(Product $product)
    {
        $product = ProductResource::collection([$product])[0];
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $requestHandler = new UpdateRequestHandler();
        $updateProductHandler = new UpdateProductHandler();

        $requestHandler->setNext($updateProductHandler);
        return $requestHandler->handle(collect(['request' => $request, 'product' => $product]));
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json('Eliminado exitosamente', 200);
        } catch (QueryException $e) {
            Log::error($e);
            return response()->json('Error de servidor interno', 500);
        }
    }
}
