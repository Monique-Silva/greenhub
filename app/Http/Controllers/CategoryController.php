<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show all website categories.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Show a specific category.
     */

    public function show(string $id)
    {
        return Category::find($id);
    }

    /**
     * It allows the user to create a category.
     */

    public function store(CategoryRequest $request)
    {
        // Validation passed, create and store the category
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return $category;
    }

    /**
     * It allows the user to update the given category.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);

        // Validation passed, create and store the category
        $category->update([
            $category->name = $request->input('name'),
        ]);
        $category->save();

        return $category;
    }
    /**
     *It allows the user to delete the category
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if ($category) {

            $category->delete();

            return response()->json([

                'Message: ' => 'category deleted with success.',

            ]);
        } else {

            return response([

                'Message: ' => 'We could not find the category.',

            ]);
        }
    }
}
