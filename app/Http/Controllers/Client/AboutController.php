<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abouts;
class AboutController extends Controller
{
    public function index()
    {
        $about = Abouts::all();
        return view('client.about.index',compact('about'));
    }
}
