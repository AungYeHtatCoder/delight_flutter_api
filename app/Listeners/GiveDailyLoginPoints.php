<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiveDailyLoginPoints
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    public function handle(Login $event)
{
    $user = $event->user;
    $today = Carbon::now()->startOfDay();
    
    // Check if the user has already logged in today
    if ($user->last_login === null || Carbon::parse($user->last_login)->lt($today)) {
        // Give points
        $user->points += 10;
        $user->last_login = Carbon::now();
        $user->save();
    }
}

}