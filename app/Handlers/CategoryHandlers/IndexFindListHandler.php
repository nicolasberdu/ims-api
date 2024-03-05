<?php

namespace App\Handlers\CategoryHandlers;

use App\Models\Category;
use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Response;

class IndexFindListHandler extends AbstractHandler
{
    public function handle(object $request): object {
        try {
            $categories = Category::where('code', 'REGEXP', $request->get('search', '.*'))
                ->orWhere('category', 'REGEXP', $request->get('search', '.*'))
                ->orWhere('description', 'REGEXP', $request->get('search', '.*'))
                ->paginate($request->get('per_page', 10))->withQueryString();

            $data = [
                'count' => $categories->count(),
                'next' => $categories->nextPageUrl(),
                'previous' => $categories->previousPageUrl(),
                'results' => CategoryResource::collection($categories),
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