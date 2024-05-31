<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Show all website orders.
     */
    public function index()
    {
        return Order::all()->load('products');
    }

    /**
     * Show a specific order.
     */

    public function show(string $id)
    {
        return Order::find($id)->load('products');
    }

    /**
     * It allows the user to create a order.
     */

    public function store(OrderRequest $request)
    {
        // Validation passed, create and store the order
        $order = new Order();
        $order->save();
        return $order;
    }

    /**
     * It allows the user to update the given order.
     */
    public function update(OrderRequest $request, string $id)
    {
        $order = Order::find($id);

        // Validation passed, create and store the order
        $order->update([
            $order->delivery_date = $request->input('delivery_date'),
            $order->bill = $request->input('bill'),
            $order->vat = $request->input('vat'),
            $order->shipping_fee = $request->input('shipping_fee'),
            $order->total_price = $request->input('total_price'),
            $order->address_id = $request->input('address_id'),
        ]);

        return $order;
    }
    /**
     *It allows the user to delete the order
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if ($order) {

            $order->delete();

            return response()->json([

                'Message: ' => 'order deleted with success.',

            ]);
        } else {

            return response([

                'Message: ' => 'We could not find the order.',

            ]);
        }
    }
}
