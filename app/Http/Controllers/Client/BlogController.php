<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blogs::all();
        return view('client.blog.index', compact('blog'));
    }
}
