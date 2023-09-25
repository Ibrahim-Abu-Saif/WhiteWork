<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;

    function company() {
        return $this->belongsTo(Company::class)->withDefault();
    }

    function user() {
        return $this->belongsTo(User::class)->withDefault();
    }
}
