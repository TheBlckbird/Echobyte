<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @psalm-suppress PropertyNotSetInConstructor */
class Rave extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'likes_count',
    ];

    /**
     * Get the comments of the rave.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Rave::class, 'parent_rave_id');
    }

    /**
     * Get the rave the reave is a comment from.
     */
    public function parentRave(): BelongsTo
    {
        return $this->belongsTo(Rave::class, 'parent_rave_id');
    }

    /**
     * Get the rave the rave is re-raving.
     */
    public function originalRave(): BelongsTo
    {
        return $this->belongsTo(Rave::class, 'original_rave_id');
    }

    /**
     * Get the re-raves of the rave.
     */
    public function reraves(): HasMany
    {
        return $this->hasMany(Rave::class, 'original_rave_id');
    }

    /**
     * Get the user that created the rave.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users that liked the Rave.
     */
    public function usersLiked(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'rave_like', 'rave_id', 'user_id');
    }
}
