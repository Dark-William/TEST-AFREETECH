<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticlesResources;
use App\Classes\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return ApiResponse::ApiResponse(ArticlesResources::collection($articles), false, 'All Article Got with Success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        DB::beginTransaction();
        try {
            $article = Article::create($request->all());
            DB::commit();
            return ApiResponse::ApiResponse(new ArticlesResources($article), false, 'Article Created with Success', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::ApiResponse(null, true, 'Error to create Article', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        if ($article) {
            return ApiResponse::ApiResponse(new ArticlesResources($article), false, 'Article Got with Success');
        }
        return ApiResponse::ApiResponse(null, true, 'Article not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $article = Article::find($id);
            if ($article) {
                $article->update($request->all());
                DB::commit();
                return ApiResponse::ApiResponse(new ArticlesResources($article), false, 'Article Updated with Success');
            }
            return ApiResponse::ApiResponse(null, true, 'Article not found', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::ApiResponse(null, true, 'Error to update Article', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $article = Article::find($id);
            if ($article) {
                $article->delete();
                DB::commit();
                return ApiResponse::ApiResponse(null, false, 'Article Deleted with Success');
            }
            return ApiResponse::ApiResponse(null, true, 'Article not found', 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::ApiResponse(null, true, 'Error to delete Article', 500);
        }
    }
}
