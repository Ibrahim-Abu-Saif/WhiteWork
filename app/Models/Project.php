<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [''];

    function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    function company()
    {
        return $this->belongsTo(Company::class)->withDefault();
    }

    function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    function user_project()
    {
        return $this->hasOne(UserProject::class)->withDefault();
    }

    function payment()
    {
        return $this->hasOne(Payment::class);
    }


    protected static function booted(): void
    {
        static::deleting(function (Project $project) {
            if (file_exists(public_path('img/' . $project->image))) {
                File::delete(public_path('img/' . $project->image));
            }
        });
    }
}
