<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    function admins() {
        return $this->hasMany(Admin::class);
    }

    function permission() {
        return $this->belongsToMany(Permission::class);
    }
}
