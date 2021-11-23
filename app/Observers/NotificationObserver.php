<?php

namespace App\Observers;

use App\Notification;
use App\Events\Notify;

class NotificationObserver
{
    /**
     * Handle the notification "created" event.
     *
     * @param  \App\Spot  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        event(new Notify($notification));
    }
}
