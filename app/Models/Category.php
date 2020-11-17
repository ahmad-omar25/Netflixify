<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    protected $fillable = ['name'];

    // Attributes ---------------------------------
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    } // end of getNameAttribute

    // relations -------------------------------------------------
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'category_movie');
    }//end of categories

    // Scopes -------------------------------------
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        });
    } // end of scopeWhenSearch
}
