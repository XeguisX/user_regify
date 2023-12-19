<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'username',
        'password',
        'email',
        'confirm_password',
        'confirm_email',
        'facebook_username',
        'twitter_username',
        'profile_image',
    ];
}
