<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogOrder
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
        Log::debug('Đơn hàng', [
            ['Product name' => $event->validatedData['product_name']],
            ['Quantity' => $event->validatedData['quantity']],
            ['Price' => $event->validatedData['price']]
        ]);

    }
}
