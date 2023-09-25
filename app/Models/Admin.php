<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends  Authenticatable
{
    use HasFactory,Notifiable;

    function role() {
        return $this->belongsTo(Role::class)->withDefault();
    }


}
