<?php

namespace App\Listeners;

use App\Models\UserActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
{
    UserActivityLog::create([
        'user_id' => $event->user->id,
        'action' => 'login',
        'ip_address' => request()->ip(),
    ]);
}
}
