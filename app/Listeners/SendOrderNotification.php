<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification implements ShouldQueue
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
    public function handle(OrderCreated $event): void
    {
        $order = $event->validatedData;
        Mail::send('orders.mail_order', $order, function ($message) {
            $message->to('l.t.dat04092004@gmail.com', 'Tutorials Point')
                ->subject('Laravel Basic Testing Mail');
        });
        // Log::debug("Basic Email Sent. Check your inbox.");
    }
}
