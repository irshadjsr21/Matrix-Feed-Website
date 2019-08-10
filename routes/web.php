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

Route::get('/', 'UserPagesController@index');
Route::get('/posts/{slug}', 'UserPagesController@showPost');
Route::get('/category/{slug}', 'UserPagesController@categoryPage');
Route::get('/profile', 'UserPagesController@showProfile');
Route::post('/profile/avatar', 'UserPagesController@updateAvatar');
Route::get('/terms-and-conditions', 'UserPagesController@showTermsAndConditions');
Route::get('/author/{id}', 'UserPagesController@showAuthorPage');

Route::get('/post-request', 'PostRequestsController@list');
Route::get('/post-request/add', 'PostRequestsController@showAdd');
Route::post('/post-request/add', 'PostRequestsController@add');
Route::get('/post-request/{id}', 'PostRequestsController@show');
Route::post('/post-request/{id}/delete', 'PostRequestsController@delete');
