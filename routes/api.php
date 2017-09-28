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

//ok
Route::post('/membres', [
  'uses' => 'MembreController@postMembre'
]);
//ok
Route::get('/membres', [
  'uses' => 'MembreController@getMembres'
]);
//ok
Route::get('/membres/{id}', [
  'uses' => 'MembreController@getMembre'
]);

Route::put('/membres/{id}', [
  'uses' => 'MembreController@putMembre'
]);

Route::delete('/membres/{id}', [
  'uses' => 'MembreController@deleteMembre'
]);
