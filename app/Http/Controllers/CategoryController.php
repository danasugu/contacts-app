<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Carbon\Carbon;

use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function AllCat()
    {
        return view('admin.category.index');
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:115',
            ],
            [
                'category_name.required' => 'Please add a category',
            ],
            [
                'category_name.max' => 'Max 115',
            ]
        );

        //DB
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        //Eloquent

            // $category = new Category;
            // $category->category_name= $request->category_name;
            // $category->user_id = Auth::user()->id;
            // $category->save();

            return Redirect()->back()->with('success', 'Category inserted succesfully');
    }
}
