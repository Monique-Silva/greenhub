<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Auth\Access\Gate;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    /**
     * Show all website products.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'Products: ' => $products,
        ]);
    }

    /**
     * Show a specific product.
     */

    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product) {

            return response()->json([
                'Message: ' => 'Product found.',
                'Product: ' => $product,
            ]);
        } else {

            return response([

                'Message: ' => 'Teh product cannot be found.',

            ]);
        }
    }

    /**
     * It allows the user to create a product.
     */

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'vat_rate' => ['required'],
            'stock' => ['required'],
            'description' => ['required'],
            'environmental_impact' => ['required'],
            'origin' => ['required'],
            'measuring_unit' => ['required'],
            'measure' => ['required'],
        ]);

        $product = Product::create($input);

        if ($product->save()) {

            return response()->json([
                'Message: ' => 'A new product was created.',
                'Product created: ' => $product
            ]);
        } else {

            return response([
                'Message: ' => 'The new product could not be created.',
            ]);
        }
    }

    /**
     * It allows the user to update the given product.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if ($product) {

            $input = $request->validate([
                'name' => ['required'],
                'price' => ['required'],
                'vat_rate' => ['required'],
                'stock' => ['required'],
                'description' => ['required'],
                'environmental_impact' => ['required'],
                'origin' => ['required'],
                'measuring_unit' => ['required'],
                'measure' => ['required'],
            ]);

            $product->name = $input['name'];
            $product->price = $input['price'];
            $product->vat_rate = $input['vat_rate'];
            $product->stock = $input['stock'];
            $product->description = $input['description'];
            $product->environmental_impact = $input['environmental_impact'];
            $product->origin = $input['origin'];
            $product->measuring_unit = $input['measuring_unit'];
            $product->measure = $input['measure'];
            $product->save();

            if ($product->save()) {

                return response()->json([

                    'Message: ' => 'Product updated with success.',
                    'Product: ' => $product

                ]);
            } else {

                return response([

                    'Message: ' => 'We could not update the product.',

                ]);
            }
        } else {

            return response([

                'Message: ' => 'We could not find the product.',

            ]);
        }
    }
    /**
     *It allows the user to delete the product, but since we don't want the product to be deleted (mostly out of stock), we can comment this function
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {

            $product->delete();

            return response()->json([

                'Message: ' => 'product deleted with success.',

            ]);
        } else {

            return response([

                'Message: ' => 'We could not find the product.',

            ]);
        }
    }
}
