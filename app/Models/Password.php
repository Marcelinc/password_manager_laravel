<?php

namespace App\Models;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'password',
        'website_id',
        'description',
        'login',
        'user_id'
    ];

    //Relationship to User
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function websites(){
        return $this->hasOne(Website::class,'website_id');
    }
}
