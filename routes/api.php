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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/profile', 'UserApiController@getData');
Route::patch('/profile', 'UserApiController@patchProfile');
Route::patch('/profile/email', 'UserApiController@patchEmail');
Route::post('/profile/password', 'UserApiController@changePassword');

Route::get('/like/{id}', 'LikeApiController@getLike');
Route::post('/like/{id}', 'LikeApiController@addLike')->middleware('auth');

Route::get('/comment/{postId}', 'CommentsApiController@getComment');
Route::post('/comment/{postId}', 'CommentsApiController@addComment')->middleware('auth');
Route::delete('/comment/{postId}/{commentId}', 'CommentsApiController@deleteComment')->middleware('auth');
