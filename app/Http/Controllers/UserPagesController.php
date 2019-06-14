<?php

namespace App\Http\Controllers;

class UserPagesController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
}
