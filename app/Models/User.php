<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
// use Jenssegers\Mongodb\Eloquent\Model;
use Mongodb\Laravel\Eloquent\Model;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * Koneksi yang digunakan model
     */
    protected $connection = 'mongodb';

    /**
     * Koleksi yang digunakan model
     */
    protected $collection = 'users';

    /**
     * Attribute yang dapat diisi secara massal
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Attribute yang harus disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute yang harus dikonversi
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}