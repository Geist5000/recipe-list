<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id id of this user
 * @property string $username the username of this user
 * @property string $password the hashed and salted password of the user
 * @property string|null $remember_token the remember token of this user
 * @property \Illuminate\Support\Carbon|null $created_at creation time of this user
 * @property \Illuminate\Support\Carbon|null $updated_at last time this user was udpated
 */
class User extends Authenticatable
{

    protected $table = 'user';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
