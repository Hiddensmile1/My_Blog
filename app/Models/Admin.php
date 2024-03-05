<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

        protected $table = 'admins';

    // protected $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'remember_token', 'password', 'updated_at', 'created_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function blog(): HasMany{
        return $this->hasMany(Blog::class);
    }

}


