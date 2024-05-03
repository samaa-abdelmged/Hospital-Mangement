<?php

use App\Models\Doctor;
use App\Models\Patient;
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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel(
    'new-invoice.{doctor_id}',
    function ($user, $doctor_id) {
        return $user->id == $doctor_id;
    },
    ['guards' => ['web', 'admin', 'doctor', 'employee', 'patient']]
);
/*
Broadcast::channel(
    'chat.{receiver_id}',
    function (Doctor $user, $receiver_id) {
        return $user->id == $receiver_id;
    },
    ['guards' => ['web', 'admin', 'patient', 'doctor', 'employee']]
);

Broadcast::channel(
    'chat2.{receiver_id}',
    function (Patient $user, $receiver_id) {
        return $user->id == $receiver_id;
    },
    ['guards' => ['web', 'admin', 'patient', 'doctor', 'employee']]
);
*/