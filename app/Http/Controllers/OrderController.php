<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Show all website orders.
     */
    public function index()
    {
        $orders = Order::all();

        return response()->json([
            'Orders: ' => $orders,
        ]);
    }

    /**
     * Show a specific order.
     */

    public function show(string $id)
    {
        $order = Order::find($id);

        if ($order) {

            return response()->json([
                'Message: ' => 'Order found.',
                'Order: ' => $order,
            ]);
        } else {

            return response([

                'Message: ' => 'The order cannot be found.',

            ]);
        }
    }

    /**
     * It allows the user to create a order.
     */

    public function store(OrderRequest $request)
    {
        // Validation passed, create and store the order
        $order = new Order();
        $order->number = $request->input('number');
        $order->order_date = $request->input('order_date');
        $order->delivery_date = $request->input('delivery_date');
        $order->bill = $request->input('bill');
        $order->vat = $request->input('vat');
        $order->shipping_fee = $request->input('shipping_fee');
        $order->total_price = $request->input('total_price');
        $order->user_id = $request->input('user_id');
        $order->adress_id = $request->input('adress_id');
        $order->save();
        if ($order->save()) {

            return response()->json([
                'Message: ' => 'A new order was created.',
                'Order created: ' => $order
            ]);
        } else {

            return response([
                'Message: ' => 'The new order could not be created.',
            ]);
        }
    }

    /**
     * It allows the user to update the given order.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);

        if ($order) {

            // Validation passed, create and store the order
            $order->update([
                $order->delivery_date = $request->input('delivery_date'),
                $order->bill = $request->input('bill'),
                $order->vat = $request->input('vat'),
                $order->shipping_fee = $request->input('shipping_fee'),
                $order->total_price = $request->input('total_price'),
                $order->adress_id = $request->input('adress_id'),
            ]);
            $order->save();

            if ($order->save()) {

                return response()->json([

                    'Message: ' => 'Order updated with success.',
                    'Order: ' => $order

                ]);
            } else {

                return response([

                    'Message: ' => 'We could not update the order.',

                ]);
            }
        } else {

            return response([

                'Message: ' => 'We could not find the order.',

            ]);
        }
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
