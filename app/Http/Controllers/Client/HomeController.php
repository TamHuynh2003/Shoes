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

        $list_products_best_selling = Products::where('rating', 4)->get();
        $list_products_new = Products::where('rating', 5)->get();
        return view('client.home.index', compact('list_products_best_selling', 'list_products_new', 'listSlides'));
    }
}
