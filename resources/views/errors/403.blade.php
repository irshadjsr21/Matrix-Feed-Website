@extends('layouts.error')

@section('title', __('Forbidden'))
@section('message', __($exception->getMessage() ?: 'Forbidden'))