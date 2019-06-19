<?php

namespace App\Http\Controllers;

class AdminPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function index()
    {
        return redirect('/admin/posts');
    }
}
