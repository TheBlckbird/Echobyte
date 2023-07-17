<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'password' => 'hashed',
    ];

    /**
     * Get the raves created by the user.
     */
    public function raves(): HasMany
    {
        return $this->hasMany(Rave::class);
    }

    /**
     * Get the Raves liked by the user.
     */
    public function likedRaves(): BelongsToMany
    {
        return $this->belongsToMany(Rave::class, 'rave_like', 'user_id', 'rave_id');
    }

    public function toggleLike(Rave $rave)
    {
        $this->likedRaves()->toggle($rave);
    }

    public function hasLiked(Rave $rave): bool
    {
        return $this->likedRaves()->where('rave_id', $rave->id)->exists();
    }
}
