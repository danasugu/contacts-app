<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Carbon\Carbon;

use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat()
    {
        // $categories = Category::all(); //get all data
        $categories = Category::latest()->paginate(5); //order DESC
        //using Query builder
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index',compact('categories') ); //pass all data in index page with compact
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

        //var 1 Eloquet ORM
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

             //var 2 Eloquent
            // $category = new Category;
            // $category->category_name= $request->category_name;
            // $category->user_id = Auth::user()->id;
            // $category->save();



            //var 3 Query Builder
            // $data = array();
            // $data['category_name'] = $request->category_name;
            // $data['user_id'] = Auth::user()->id;
            // DB::table('categories')->insert($data);

            return Redirect()->back()->with('success', 'Category inserted succesfully');
    }

     public function search(Request $request)
    {
        //get the general information about the website
        // $website = Category::query()->firstOrFail();

        $key = trim($request->get('q'));

        $posts = Category::query()
            ->where('category_name', 'like', "%{$key}%")
            // ->orWhere('content', 'like', "%{$key}%")
            // ->orderBy('created_at', 'desc')
            ->get();

        //get all the categories
        $categories = Category::all();

        //get all the tags
        // $tags = Tag::all();

        //get the recent 5 posts
        $recent_posts = Category::query()
            ->where('user_id', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('search', [
            // 'website' => $website,
            'key' => $key,
            // 'posts' => $posts,
            'categories' => $categories,
            // 'tags' => $tags,
            // 'recent_posts' => $recent_posts
        ]);
    }
}
