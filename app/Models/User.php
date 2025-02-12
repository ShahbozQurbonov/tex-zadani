<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
// use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = ['name','surname','patronymic', 'login', 'password', 'avatar'];

    protected $hidden = ['password', 'remember_token'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->login) {
                $user->login = str_pad(User::count() + 1, 6, '0', STR_PAD_LEFT); // Generatsiya
            }
        });
    }
}
