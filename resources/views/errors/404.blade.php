@extends('layouts.error')

@section('title', __('Page Not Found'))
@section('message', __($exception->getMessage() ?: 'The page you are looking for does not exist.'))