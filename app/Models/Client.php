<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $fillable=[
        'role_id',
        'name',
        'email',
        'email_confirmation_token',
        'password',
        'phone_number',
        'phone_confirmation_token',
        'address',
        'image',
        'is_active',
        'is_banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }
}
