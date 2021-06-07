<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Article;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('test', function (){
   $a=  Article::create([
        'title' => '12341414',
        'slug' => '12341414',
        'categories_id' => '1',
        'short_desc' => 1,
        'content' => '123',
        'status' =>'12321'
    ]);
   return $a;
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/article', 'ArticleController');
    Route::resource('/categories', 'CategoriesController');
  });
