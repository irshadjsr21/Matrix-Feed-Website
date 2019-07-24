<?php

Route::get('/login', 'CustomAuth\AuthController@loginPage')->name('login');
Route::get('/signup', 'CustomAuth\AuthController@signupPage');
Route::post('/login', 'CustomAuth\AuthController@login');
Route::post('/signup', 'CustomAuth\AuthController@signup');
Route::post('/logout', 'CustomAuth\AuthController@logout');
