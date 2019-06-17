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

Route::get('/admin', 'AdminPagesController@index');
Route::get('/admin/posts', 'AdminPagesController@listPosts');
Route::get('/admin/posts/add', 'AdminPagesController@addPostPage');
Route::post('/admin/posts', 'AdminPagesController@addPost');
Route::get('/admin/posts/{id}', 'AdminPagesController@showPost');
Route::post('/admin/posts/{id}/delete', 'AdminPagesController@deletePost');
Route::get('/admin/posts/{id}/edit', 'AdminPagesController@editPostPage');
Route::post('/admin/posts/{id}/edit', 'AdminPagesController@editPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
