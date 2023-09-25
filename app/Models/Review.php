<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    function company() {
        return $this->belongsTo(Company::class)->withDefault();
    }

    function user_project() {
        return $this->belongsTo(UserProject::class)->withDefault();
    }
}
