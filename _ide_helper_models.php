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
 * App\Models\Character
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $starship_id
 * @property int|null $engineering_mod
 * @property string|null $picture_url
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Division[] $divisions
 * @property-read int|null $divisions_count
 * @property-read \App\Models\Starship $starship
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CharacterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereEngineeringMod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character wherePictureUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereStarshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUserId($value)
 */
	class Character extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Division
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Starship[] $starships
 * @property-read int|null $starships_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\System[] $systems
 * @property-read int|null $systems_count
 * @method static \Database\Factories\DivisionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Division newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division query()
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereUpdatedAt($value)
 */
	class Division extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Starship
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string|null $model
 * @property string|null $manufacturer
 * @property int|null $captain_id
 * @property int $dm_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Division[] $divisions
 * @property-read int|null $divisions_count
 * @property-read \App\Models\User $dm
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\System[] $systems
 * @property-read int|null $systems_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\StarshipFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Starship newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Starship query()
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereDmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Starship whereUpdatedAt($value)
 */
	class Starship extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\System
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $division_action
 * @property int $max_hp
 * @property int $current_hp
 * @property int $starship_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Division[] $divisions
 * @property-read int|null $divisions_count
 * @property-read \App\Models\Starship $starship
 * @method static \Database\Factories\SystemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|System newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System query()
 * @method static \Illuminate\Database\Eloquent\Builder|System whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereCurrentHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereDivisionAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereMaxHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereStarshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereUpdatedAt($value)
 */
	class System extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $is_admin
 * @property int $is_dm
 * @property string|null $ui_color
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Starship[] $starships
 * @property-read int|null $starships_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Starship[] $starshipsAsDm
 * @property-read int|null $starships_as_dm_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsDm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUiColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

