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

Route::get('/author', 'Admin\AuthorController@listAuthor');
Route::get('/author/add', 'Admin\AuthorController@addAuthorPage');
Route::post('/author', 'Admin\AuthorController@addAuthor');
Route::get('/author/{id}', 'Admin\AuthorController@showAuthor');
Route::post('/author/{id}/delete', 'Admin\AuthorController@deleteAuthor');
Route::get('/author/{id}/edit', 'Admin\AuthorController@editAuthorPage');
Route::post('/author/{id}/edit', 'Admin\AuthorController@editAuthor');

Route::get('/post-request', 'Admin\PostRequestController@list');
Route::get('/post-request/{id}', 'Admin\PostRequestController@show');
Route::post('/post-request/{id}/accept', 'Admin\PostRequestController@accept');
Route::post('/post-request/{id}/reject', 'Admin\PostRequestController@reject');
Route::post('/post-request/{id}/delete', 'Admin\PostRequestController@delete');
