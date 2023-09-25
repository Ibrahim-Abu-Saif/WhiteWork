<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    function project() {
        return $this->belongsTo(Project::class)->withDefault();
    }
}
