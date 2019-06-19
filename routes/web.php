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

Route::get('/admin/posts', 'AdminPostsController@listPosts');
Route::get('/admin/posts/add', 'AdminPostsController@addPostPage');
Route::post('/admin/posts', 'AdminPostsController@addPost');
Route::get('/admin/posts/{id}', 'AdminPostsController@showPost');
Route::post('/admin/posts/{id}/delete', 'AdminPostsController@deletePost');
Route::get('/admin/posts/{id}/edit', 'AdminPostsController@editPostPage');
Route::post('/admin/posts/{id}/edit', 'AdminPostsController@editPost');

Route::get('/admin/category', 'AdminCategoryController@listCategory');
Route::get('/admin/category/add', 'AdminCategoryController@addCategoryPage');
Route::post('/admin/category', 'AdminCategoryController@addCategory');
Route::get('/admin/category/{id}', 'AdminCategoryController@showCategory');
Route::post('/admin/category/{id}/delete', 'AdminCategoryController@deleteCategory');
Route::get('/admin/category/{id}/edit', 'AdminCategoryController@editCategoryPage');
Route::post('/admin/category/{id}/edit', 'AdminCategoryController@editCategory');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
