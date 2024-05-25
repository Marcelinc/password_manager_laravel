<?php

namespace App\Models;

use App\Models\User;
use App\Models\IpAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'successful',
        'device',
        'session',
        'id_user',
        'id_address'
    ];

    //Relationship
    public function users(){
        return $this->hasOne(User::class,'id_user');
    }
    public function ip_addresses(){
        return $this->hasOne(IpAddress::class,'id_address');
    }
}
