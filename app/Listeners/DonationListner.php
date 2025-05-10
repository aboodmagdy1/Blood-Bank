<?php

namespace App\Listeners;

use App\Events\NotifyDooners;
use App\Http\Controllers\Notifications\DonationRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class DonationListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /*
     * Handle the event.
     */
    public function handle(NotifyDooners $event): void
    {
        Notification::send($event->clients,new DonationRequestNotification($event->notification));
    }
}
