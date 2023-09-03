<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Rave
 *
 * @psalm-suppress PropertyNotSetInConstructor
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property int|null $parent_rave_id
 * @property int|null $original_rave_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rave> $comments
 * @property-read int|null $comments_count
 * @property-read Rave|null $originalRave
 * @property-read Rave|null $parentRave
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rave> $reraves
 * @property-read int|null $reraves_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usersLiked
 * @property-read int|null $users_liked_count
 * @method static \Database\Factories\RaveFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rave newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rave newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rave query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereOriginalRaveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereParentRaveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rave whereUserId($value)
 */
	class Rave extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rave> $likedRaves
 * @property-read int|null $liked_raves_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rave> $raves
 * @property-read int|null $raves_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

