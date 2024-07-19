<?php

namespace App\Listeners;

use App\Events\OderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogOrderShipped
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
    public function handle(OderShipped $event): void
    {
        Log::debug(__CLASS__, ['event' => 'ahhi']);


    }
}
