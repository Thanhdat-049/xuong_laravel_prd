<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Stock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStock
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

        $data = Stock::query()->where('product_name', $event->validatedData['product_name'])->first();
        $quantity = $data->quantity - $event->validatedData['quantity'];
        $data->update([
            'quantity' => $quantity
        ]);
    }
}
