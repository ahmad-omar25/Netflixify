<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::whereRole('user')->count();
        $categories_count = Category::count();
        $movies_count = Movie::where('percent', 100)->count();

        return view('dashboard.home', compact('users_count', 'categories_count', 'movies_count'));
    } // end of index
}
