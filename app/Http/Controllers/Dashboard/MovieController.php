<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:movies_read')->only(['index']);
        $this->middleware('permission:movies_create')->only(['create', 'store']);
        $this->middleware('permission:movies_update')->only(['edit', 'update']);
        $this->middleware('permission:movies_delete')->only(['delete']);
    }

    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        $movies = Movie::whenSearch(request()->search)
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view('dashboard.movies.index', compact('movies', 'categories'));
    } // end of index

    public function create()
    {
        $categories = Category::all();
        $movie = Movie::create([]);
        return view('dashboard.movies.create', compact('movie', 'categories'));
    } // end of create

    public function store(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $movie->update([
            'name' => $request->name,
            'path' => $request->file('movie')->store('movies'),
        ]);
        // the job in background
        $this->dispatch(new StreamMovie($movie));
        return $movie;
    } // end of store

    public function edit(Movie $movie)
    {

        $categories = Category::all();
        return view('dashboard.movies.edit', compact('movie', 'categories'));
    }//end of edit

    public function show($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.roles.index');
        }
        return $movie;
    }//end of show

    public function update(Request $request, Movie $movie)
    {
        if ($request->type == 'publish') {

            $request->validate([
                'name' => 'required|unique:movies,name,' . $movie->id,
                'description' => 'sometimes|nullable',
                'poster' => 'required|image',
                'image' => 'required|image',
                'year' => 'required',
                'categories' => 'required',
                'rating' => 'required|max:10',
            ]);
        } else {
            $request->validate([
                'name' => 'required|unique:movies,name,' . $movie->id,
                'description' => 'sometimes|nullable',
                'poster' => 'sometimes|nullable|image',
                'image' => 'sometimes|nullable|image',
                'year' => 'required',
                'categories' => 'required',
                'rating' => 'required|max:10',
            ]);
        }
        $request_date = $request->except(['_token', 'poster', 'image']);
        if ($request->poster) {
            $this->remove_previous('poster', $movie);
            $poster = Image::make($request->poster)->resize(255, 378)->encode('jpg');
            Storage::disk('local')->put('public/images/' . $request->poster->hashName(), (string)$poster, 'public');
            $request_date['poster'] = $request->poster->hashName();
        }
        if ($request->image) {
            $this->remove_previous('image', $movie);
            $image = Image::make($request->image)->encode('jpg', 50);
            Storage::disk('local')->put('public/images/' . $request->image->hashName(), (string)$image, 'public');
            $request_date['image'] = $request->image->hashName();
        }
        $movie->update($request_date);
        $movie->categories()->sync($request->categories);
        toast('Data updated successfully', 'success');
        return redirect()->route('dashboard.movies.index');
    } // end of update

    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.movies.index');
        }
        Storage::disk('local')->delete('public/images/' . $movie->poster);
        Storage::disk('local')->delete('public/images/' . $movie->image);
        Storage::disk('local')->delete($movie->path);
        Storage::disk('local')->deleteDirectory('public/movies/' . $movie->id);
        $movie->delete();
        toast('Data deleted successfully', 'success');
        return redirect()->route('dashboard.movies.index');
    } // end of destroy

    private function remove_previous($image_type, $movie)
    {
        if ($image_type == 'poster') {
            if ($movie->poster != null) {
                Storage::disk('local')->delete('public/images/' . $movie->poster);
            }
        } else {
            if ($movie->image != null) {
                Storage::disk('local')->delete('public/images/' . $movie->image);
            }
        }
    }//end of remove_previous

}// end of controller
