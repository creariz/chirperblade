<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the chirps for the user. Set relationship to one-to-many.
     */
    public function chirps():HasMany
    {   
        /**
         * The relationship between the User and Chirp models is a one-to-many relationship. 
         * A user can have many chirps, but a chirp can only belong to one user.
         * 
         * The hasMany method is used to define a one-to-many relationship. 
         * This method accepts two arguments: the related model and the foreign key of the relationship.
         * 
         * The foreign key is the column name of the table that references the primary key of the related model. 
         * In this case, the users table has a primary key of id, and the chirps table has a user_id column that references the id column of the users table.
         * 
         * The hasMany method will return a Illuminate\Database\Eloquent\Relations\HasMany object. 
         * This object is used to define further relationships for the model.
         */
        return $this->hasMany(Chirp::class);
    }
}
