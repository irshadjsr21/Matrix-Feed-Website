<?php
Route::get('/', 'AdminPagesController@index');

Route::get('/posts', 'AdminPostsController@listPosts');
Route::get('/posts/add', 'AdminPostsController@addPostPage');
Route::post('/posts', 'AdminPostsController@addPost');
Route::get('/posts/{id}', 'AdminPostsController@showPost');
Route::post('/posts/{id}/delete', 'AdminPostsController@deletePost');
Route::get('/posts/{id}/edit', 'AdminPostsController@editPostPage');
Route::post('/posts/{id}/edit', 'AdminPostsController@editPost');

Route::get('/category', 'AdminCategoryController@listCategory');
Route::get('/category/add', 'AdminCategoryController@addCategoryPage');
Route::post('/category', 'AdminCategoryController@addCategory');
Route::get('/category/{id}', 'AdminCategoryController@showCategory');
Route::post('/category/{id}/delete', 'AdminCategoryController@deleteCategory');
Route::get('/category/{id}/edit', 'AdminCategoryController@editCategoryPage');
Route::post('/category/{id}/edit', 'AdminCategoryController@editCategory');