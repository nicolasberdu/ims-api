<?php

namespace App\Handlers\CategoryHandlers;

use App\Models\Category;
use App\Handlers\AbstractHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class UpdateCategoryHandler extends AbstractHandler {

    public function handle(object $request): object {
        try {
            $category = $request['category'];
            $category->update($request['validator']->safe()->only(['code', 'category', 'description']));

            return response()->json($category, 200);
        } catch (QueryException $e) {
            Log::error($e);
            return response()->json($e->getMessage(), 500);
            return response()->json('Error de servidor interno', 500);
        }
    }
}