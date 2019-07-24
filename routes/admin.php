<?php
Route::get('/', 'Admin\PagesController@index');

Route::get('/posts', 'Admin\PostsController@listPosts');
Route::get('/posts/add', 'Admin\PostsController@addPostPage');
Route::post('/posts', 'Admin\PostsController@addPost');
Route::get('/posts/{id}', 'Admin\PostsController@showPost');
Route::post('/posts/{id}/delete', 'Admin\PostsController@deletePost');
Route::get('/posts/{id}/edit', 'Admin\PostsController@editPostPage');
Route::post('/posts/{id}/edit', 'Admin\PostsController@editPost');

Route::get('/category', 'Admin\CategoryController@listCategory');
Route::get('/category/add', 'Admin\CategoryController@addCategoryPage');
Route::post('/category', 'Admin\CategoryController@addCategory');
Route::get('/category/{id}', 'Admin\CategoryController@showCategory');
Route::post('/category/{id}/delete', 'Admin\CategoryController@deleteCategory');
Route::get('/category/{id}/edit', 'Admin\CategoryController@editCategoryPage');
Route::post('/category/{id}/edit', 'Admin\CategoryController@editCategory');