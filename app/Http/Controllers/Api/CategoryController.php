<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\CategoryResource;
use App\Handlers\CategoryHandlers\IndexRequestHandler;
use App\Handlers\CategoryHandlers\StoreRequestHandler;
use App\Handlers\CategoryHandlers\IndexFindListHandler;
use App\Handlers\CategoryHandlers\StoreCategoryHandler;
use App\Handlers\CategoryHandlers\UpdateRequestHandler;
use App\Handlers\CategoryHandlers\UpdateCategoryHandler;

class CategoryController extends Controller
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
        $storeCategoryHandler = new StoreCategoryHandler();

        $requestHandler->setNext($storeCategoryHandler);
        return $requestHandler->handle($request);
    }

    public function show(Category $category)
    {
        $category = CategoryResource::collection([$category])[0];
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $requestHandler = new UpdateRequestHandler();
        $updateCategoryHandler = new UpdateCategoryHandler();

        $requestHandler->setNext($updateCategoryHandler);
        return $requestHandler->handle(collect(['request' => $request, 'category' => $category]));
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json('Eliminado exitosamente', 200);
        } catch (QueryException $e) {
            Log::error($e);
            return response()->json($e->getMessage(), 500);
            return response()->json('Error de servidor interno', 500);
        }

    }
}
