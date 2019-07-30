<?php

Route::get('/login', 'CustomAuth\AuthController@loginPage')->name('login')->middleware('guest');
Route::get('/signup', 'CustomAuth\AuthController@signupPage')->middleware('guest');
Route::post('/login', 'CustomAuth\AuthController@login');
Route::post('/signup', 'CustomAuth\AuthController@signup');
Route::post('/logout', 'CustomAuth\AuthController@logout');
Route::get('/oauth/facebook', 'CustomAuth\AuthController@facebookRedirect');
Route::get('/oauth/facebook/callback', 'CustomAuth\AuthController@facebookCallback');
Route::get('/oauth/google', 'CustomAuth\AuthController@googleRedirect');
Route::get('/oauth/google/callback', 'CustomAuth\AuthController@googleCallback');
