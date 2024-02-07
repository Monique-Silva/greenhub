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
        $categories = Category::all();

        return response()->json([
            'Categories: ' => $categories,
        ]);
    }

    /**
     * Show a specific category.
     */

    public function show(string $id)
    {
        $category = Category::find($id);

        if ($category) {

            return response()->json([
                'Message: ' => 'Category found.',
                'Category: ' => $category,
            ]);
        } else {

            return response([

                'Message: ' => 'The category cannot be found.',

            ]);
        }
    }

    /**
     * It allows the user to create a category.
     */

    public function store(CategoryRequest $request)
    {
        // Validation passed, create and store the category
        $category = new Category();
        $category->name = $request->input('name');
        if ($category->save()) {

            return response()->json([
                'Message: ' => 'A new category was created.',
                'Category created: ' => $category
            ]);
        } else {

            return response([
                'Message: ' => 'The new category could not be created.',
            ]);
        }
    }

    /**
     * It allows the user to update the given category.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if ($category) {

            // Validation passed, create and store the category
            $category->update([
                $category->name = $request->input('name'),
            ]);
            $category->save();

            if ($category->save()) {

                return response()->json([

                    'Message: ' => 'Category updated with success.',
                    'Category: ' => $category

                ]);
            } else {

                return response([

                    'Message: ' => 'We could not update the category.',

                ]);
            }
        } else {

            return response([

                'Message: ' => 'We could not find the category.',

            ]);
        }
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
