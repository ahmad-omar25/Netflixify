<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories_read')->only(['index']);
        $this->middleware('permission:categories_create')->only(['create', 'store']);
        $this->middleware('permission:categories_update')->only(['edit', 'update']);
        $this->middleware('permission:categories_delete')->only(['delete']);
    }

    public function index()
    {
        $categories = Category::whenSearch(request()->search)
            ->withCount('movies')
            ->orderBy('id', 'desc')->paginate(8);
        return view('dashboard.categories.index', compact('categories'));
    } // end of index

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|unique:categories,name',
        ]);
        Category::create($request->all());
        toast('Data created successfully', 'success');
        return redirect()->route('dashboard.categories.index');
    } // end of store

    public function edit($id)
    {
        $category = Category::whereSlug($id)->orWhere('id', $id)->first();
        if (!$category) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.categories.index');
        }
        return view('dashboard.categories.edit', compact('category'));
    } // end of edit

    public function update(Request $request, $id)
    {
        $category = Category::whereSlug($id)->orWhere('id', $id)->first();
        $request->validate([
            'name' => 'required|min:5|unique:categories,name,' . $category->id,
        ]);
        if (!$category) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.categories.index');
        }
        $category->update($request->except('_token'));
        toast('Data updated successfully', 'success');
        return redirect()->route('dashboard.categories.index');
    } // end of update

    public function destroy($id)
    {
        $category = Category::whereSlug($id)->orWhere('id', $id)->first();
        if (!$category) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.categories.index');
        }
        $category->delete();
        toast('Data deleted successfully', 'success');
        return redirect()->route('dashboard.categories.index');
    } // end of destroy

} // end of controller
