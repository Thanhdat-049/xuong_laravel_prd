<?php

namespace App\Http\Controllers;

use App\Events\OderShipped;
use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        OderShipped::dispatch('okok');
        dd(1);
    }
    public function order()
    {
        $data = Order::query()->paginate(10);
        return view('orders.list', compact('data'));
    }
    public function create()
    {
        $product_name = Stock::all();
        return view('orders.create', compact('product_name'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        // dd($validatedData['product_name']);

        Order::create($validatedData);
        OrderCreated::dispatch($validatedData);

        return redirect()->route('order')->with('msg', 'Thêm thành công');
    }
}
