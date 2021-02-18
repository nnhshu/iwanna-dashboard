<?php

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Response;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article', function(){
    $articles = Article::all();
    return Response::json($articles);
});

Route::get('/article/{slug}', function($slug){
    $article = Article::where('slug', $slug)->first();
    return Response::json($article);
}); 

