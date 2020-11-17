<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use Sluggable;

    // Sluggable ---------------------------------
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'description',
        'path',
        'poster',
        'image',
        'year',
        'rating',
        'percent'
    ];
    protected $appends = ['poster_path', 'image_path'];

    //attributes --------------------------------------
    public function getPosterPathAttribute()
    {
        return Storage::url('images/' . $this->poster);

    }// end of getPosterPathAttribute

    public function getImagePathAttribute()
    {
        return Storage::url('images/' . $this->image);

    }// end of getImagePathAttribute

    // Scopes -------------------------------------
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
                ->orWhere('year', 'like', "%$search%")
                ->orWhere('rating', 'like', "%$search%");
        });
    } // end of scopeWhenSearch

    public function scopeWhereCategory($query, $category)
    {
        return $query->whereHas('categories', function ($q) use ($category) {
            return $q->whereIn('name', (array)$category)
                ->orWhereIn('category_id', (array)$category);
        });
    }// end of scopeWhereRoleNot

    // relations -------------------------------------------------
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_movie');
    }//end of categories
}
