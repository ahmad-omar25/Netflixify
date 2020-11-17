<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {

    }// end of index

    public function show($id)
    {
        $movie = Movie::whereSlug($id)->orWhere('id', $id)->first();
        $related_movies = Movie::where('id', '!=', $movie->id)
            ->whereHas('categories', function ($query) use ($movie) {
                return $query->whereIn('category_id', $movie->categories->pluck('id')->toArray());
            })->get();

        return view('frontend.movies.show', compact('movie', 'related_movies'));
    }// end of show

}// end of controller
