<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class PagesController extends Controller
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
