<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\DB\CategoryRepository;
use App\Helpers\Responses\CategoryResponse;
use App\Http\Requests\Tasks\CreateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = CategoryRepository::getCategories();
        }
        catch (\Throwable $th) {
            return CategoryResponse::failed();
        }

        return CategoryResponse::indexSuccess($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $inputData = $this->prepareStoreData($request);

        try {
            $category = CategoryRepository::createCategory($inputData);
        }
        catch (\Throwable $th) {
            return CategoryResponse::failed();
        }

        return CategoryResponse::createSuccess($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $isDeleted = $this->deleteCategory($category);

        return ($isDeleted) ? 
            CategoryResponse::destroySuccess() :
            CategoryResponse::failed();
    }


    private function prepareStoreData($dataObj)
    {
        $data = $dataObj->validated();
        $data['user_id'] = auth()->user()->id; //add user_id to data

        return $data;
    }

    private function deleteCategory(Category $category)
    {
        try {
            $category->delete();
        }
        catch (\Throwable $th) {
            return false;
        }

        return true;
    }
}
