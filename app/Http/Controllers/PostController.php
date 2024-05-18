<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function top()
    {
        return view('seichi/top');
    }
}
