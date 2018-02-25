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
//Route::post('/membres', [
  //'uses' => 'MembreController@postMembre'
//]);

Route::post('/membres/signup', [
  'uses' => 'MembreController@signup'
]);

Route::post('/membres/signin', [
  'uses' => 'MembreController@signin'
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
  'uses' => 'ArticleController@postArticle',
  'middleware' => 'auth.jwt'
]);

Route::get('/articles', [
  'uses' => 'ArticleController@getArticles'
]);

Route::get('/articles/{id}', [
  'uses' => 'ArticleController@getArticle'
]);

Route::put('/articles/{id}', [
  'uses' => 'ArticleController@putArticle',
  'middleware' => 'auth.jwt'
]);

Route::delete('/articles/{id}', [
  'uses' => 'ArticleController@deleteArticle',
  'middleware' => 'auth.jwt'
]);

//-------------------Routes Emprunt---------------------

Route::post('/emprunts', [
  'uses' => 'EmpruntController@postEmprunt',
  'middleware' => 'auth.jwt'
]);

Route::get('/emprunts', [
  'uses' => 'EmpruntController@getEmprunts'
]);

Route::get('/emprunts/{id}', [
  'uses' => 'EmpruntController@getEmprunt'
]);

Route::put('/emprunts/{id}', [
  'uses' => 'EmpruntController@putEmprunt',
  'middleware' => 'auth.jwt'
]);

Route::delete('/emprunts/{id}', [
  'uses' => 'EmpruntController@deleteEmprunt',
  'middleware' => 'auth.jwt'
]);

//-------------------Routes Contact---------------------

Route::post('/contact', [
  'uses' => 'ContactController@postMail'
]);
