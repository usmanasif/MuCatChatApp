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

Broadcast::channel('user-messanger-{id}-{receiver}', function ($user, $id, $receiver) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('online-users', function ($user) {
   return $user;
});

//Broadcast::channel('App.Models.User.{id}.Messages', function ($user, $id) {
//    return (int) $user->id == (int) $id;
//});
