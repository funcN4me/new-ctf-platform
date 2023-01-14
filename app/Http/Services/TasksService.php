<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Subcategory;

class TasksService
{
    public static function prepareTaskInput(array $input): array
    {
        if (!is_numeric($input['category_id'])) {
            $category = Category::create(['name' => $input['category_id']]);
            $input['category_id'] = $category->id;
        }

        if (!is_numeric($input['subcategory_id'])) {
            $subcategory = Subcategory::create(['name' => $input['subcategory_id']]);
            $input['subcategory_id'] = $subcategory->id;
        }

        return $input;
    }
}
