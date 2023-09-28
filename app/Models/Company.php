<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory,Notifiable;
    protected $guarded=[''];

    function employees() {
        return $this->hasMany(User::class);
    }

    function projects() {
        return $this->hasMany(Project::class);
    }

    function reviews() {
        return $this->hasMany(Review::class);
    }

    function my_reviews() {
        return $this->hasMany(CompanyReview::class);
    }

    function payments() {
        return $this->hasMany(Payment::class);
    }

    function getImageAttribute($value){
        $src=asset('img/default.png');
        if($value){
            $src=asset('img/'.$value);
        }
        return $src;
    }


}
