<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedPassword extends Model
{
    use HasFactory;

    //Relationship
    public function users_owner(){
        return $this->hasOne(User::class,'id_owner');
    }

    public function users_receiver(){
        return $this->hasOne(User::class,'id_receiver');
    }
    public function passwords(){
        return $this->hasOne(Password::class,'id_password');
    }
}
