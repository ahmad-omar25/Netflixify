<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = ['name'];

    // Scopes -------------------------------------
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%");
        });
    }// end of scopeWhenSearch

    public function scopeWhereRoleNot($query, $role_name)
    {
        return $query->whereNotIn('name', (array)$role_name);
    }// end of scopeWhereRoleNot
}
