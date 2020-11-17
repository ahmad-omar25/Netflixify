<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $latest_movies = Movie::latest()->limit(3)->get();
        $categories = Category::with('movies')->get();
        return view('frontend.home', compact('latest_movies', 'categories'));
    }// end of index
}
