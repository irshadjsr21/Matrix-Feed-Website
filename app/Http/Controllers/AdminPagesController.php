<?php

namespace App\Http\Controllers;

class AdminPagesController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
}
