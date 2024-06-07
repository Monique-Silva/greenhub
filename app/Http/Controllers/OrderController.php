<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrdersHasProducts;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

     public function store(Request $request)
     {
         $validated = $request->validate([
             'address_id' => 'required|uuid',
             'payment_method' => 'required|string',
             'cart' => 'required|array',
             'cart.*.id' => 'required|integer',
             'cart.*.quantity' => 'required|integer',
             'cart.*.price' => 'required|numeric',
         ]);

         $user = Auth::user();
         $subtotal = collect($validated['cart'])->sum(fn($item) => $item['price'] * $item['quantity']);
         $vat = $subtotal * 0.2; // Assuming 20% VAT
         $shippingFee = 10.00; // Fixed shipping fee, modify as needed
         $totalPrice = $subtotal + $vat + $shippingFee;

         // Create Order
         $order = Order::create([
             'id' => (string) Str::uuid(),
             'number' => Order::max('number') + 1, // Auto-increment order number
             'order_date' => Carbon::now(),
             'delivery_date' => Carbon::now()->addDays(7), // Assuming 7 days delivery, modify as needed
             'bill' => $subtotal,
             'vat' => $vat,
             'shipping_fee' => $shippingFee,
             'total_price' => $totalPrice,
             'user_id' => $user->id,
             'address_id' => $validated['address_id'],
         ]);

         // Create Order Items using OrdersHasProducts
         foreach ($validated['cart'] as $cartItem) {
             OrdersHasProducts::create([
                 'order_id' => $order->id,
                 'product_id' => $cartItem['id'],
                 'quantity' => $cartItem['quantity'],
                 'unit_price' => $cartItem['price'],
                 'unit_price_vat' => $cartItem['price'] * 1.2, // Assuming 20% VAT included price
             ]);
         }

         return response()->json(['message' => 'Order created successfully', 'order_id' => $order->id], 201);
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
