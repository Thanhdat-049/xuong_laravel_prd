<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Support\Facades\Log;

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
        $validatedData = $event->validatedData;
        $level = 'success';

        Log::create([   
            'level' => $level,
            'message' => "Đơn hàng mới được tạo: Sản phẩm {$validatedData['product_name']}, Số lượng: {$validatedData['quantity']}, Giá: {$validatedData['price']}",
        ]);

    }
}
