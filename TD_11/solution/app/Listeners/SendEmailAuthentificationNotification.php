<?php

namespace App\Listeners;

use App\Mail\UserConnected;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

class SendEmailAuthentificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Authenticated  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        Mail::to($user->email)->queue(new UserConnected($user));
    }
}
