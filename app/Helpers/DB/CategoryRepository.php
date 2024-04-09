<?php 

namespace App\Helpers\DB;
use App\Models\Category;


class CategoryRepository
{
    public static function getCategories()
    {
        return Category::query()->orderByDesc('created_at')->get();
    }


    public static function createCategory(array $data)
    {
        return Category::create($data);
    }
}
