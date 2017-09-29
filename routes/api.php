<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//-------------------Routes membres---------------------
Route::post('/membres', [
  'uses' => 'MembreController@postMembre'
]);

Route::get('/membres', [
  'uses' => 'MembreController@getMembres'
]);

Route::get('/membres/{id}', [
  'uses' => 'MembreController@getMembre'
]);

Route::put('/membres/{id}', [
  'uses' => 'MembreController@putMembre'
]);

Route::delete('/membres/{id}', [
  'uses' => 'MembreController@deleteMembre'
]);


//-------------------Routes Articles---------------------

Route::post('/articles', [
  'uses' => 'ArticleController@postArticle'
]);

Route::get('/articles', [
  'uses' => 'ArticleController@getArticles'
]);

Route::get('/articles/{id}', [
  'uses' => 'ArticleController@getArticle'
]);

Route::put('/articles/{id}', [
  'uses' => 'ArticleController@putArticle'
]);

Route::delete('/articles/{id}', [
  'uses' => 'ArticleController@deleteArticle'
]);
