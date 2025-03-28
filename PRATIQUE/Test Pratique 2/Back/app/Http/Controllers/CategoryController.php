<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ApiResponse;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return ApiResponse::ApiResponse(CategoryResource::collection($categories), false, 'All Category Got with Success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = Category::create($request->all());
            DB::commit();
            return ApiResponse::ApiResponse(new CategoryResource($category), false, 'Category Created with Success', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::ApiResponse(null, true, 'Error to create Category', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            return ApiResponse::ApiResponse(new CategoryResource($category), false, 'Category Got with Success');
        }
        return ApiResponse::ApiResponse(null, true, 'Category not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            if ($category) {
                $category->update($request->all());
                DB::commit();
                return ApiResponse::ApiResponse(new CategoryResource($category), false, 'Category Updated with Success');
            }
            return ApiResponse::ApiResponse(null, true, 'Category not found', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::ApiResponse(null, true, 'Error to update Category', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                DB::commit();
                return ApiResponse::ApiResponse(null, false, 'Category Deleted with Success');
            }
            return ApiResponse::ApiResponse(null, true, 'Category not found', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::ApiResponse(null, true, 'Error to delete Category', 500);
        }
    }
}
