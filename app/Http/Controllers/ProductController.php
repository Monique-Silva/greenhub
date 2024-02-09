<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Show all website products.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show a specific product.
     */

    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * It allows the user to create a product.
     */

    public function store(ProductRequest $request)
    {
        $this->authorize('create');

        // Validation passed, create and store the product
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->vat_rate = $request->input('vat_rate');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');
        $product->environmental_impact = $request->input('environmental_impact');
        $product->origin = $request->input('origin');
        $product->measuring_unit = $request->input('measuring_unit');
        $product->measure = $request->input('measure');
        $product->save();
        return $product;
    }

    /**
     * It allows the user to update the given product.
     */
    public function update(ProductRequest $request, string $id)
    {

        $product = Product::find($id);
        $this->authorize('update', [$product, $request->category]);

        if ($product) {
            // Validation passed, create and store the product
            $product->update([
                $product->name = $request->input('name'),
                $product->price = $request->input('price'),
                $product->vat_rate = $request->input('vat_rate'),
                $product->stock = $request->input('stock'),
                $product->description = $request->input('description'),
                $product->environmental_impact = $request->input('environmental_impact'),
                $product->origin = $request->input('origin'),
                $product->measuring_unit = $request->input('measuring_unit'),
                $product->measure = $request->input('measure')
            ]);
            return $product;
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
