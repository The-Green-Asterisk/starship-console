<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('presenceStarshipConsole.{starshipId}', function ($user, $starshipId) {
    if ($user->is_dm || $user->characters->where('is_active', true)->where('starship_id', $starshipId)->count() > 0)
        return $user->toArray();
});
