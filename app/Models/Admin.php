<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends  Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;
    
    protected $guarded=[''];

    function role() {
        return $this->belongsTo(Role::class)->withDefault();
    }

    public function path(){
        $img=asset('backAdmin/img/undraw_profile.svg');
        if($this->image){
            $img=asset('img/'.$this->image);
        }
        return $img;
    }


}
