<?php

namespace App\Http\Controllers\Client;

use App\Models\Products;
use App\Models\SlideShows;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $listSlides = SlideShows::where('is_deleted', 1)->get();

        $list_products = Products::where('rating', 5)->get();
        return view('client.home.index', compact('list_products', 'listSlides'));
    }
}