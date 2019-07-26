@extends('layouts.error')

@section('title', __('Service Unavailable'))
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
