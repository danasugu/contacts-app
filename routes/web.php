<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Request;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $users = User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');

Route::get('/categories/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::post('/search', function() 
        {
            $q = request::get('q');
            // dd($q);
            if($q != "")
            {
                $user = Category::where('category_name', 'LIKE', '%' . $q . '%')
                                    ->orWhere('user_id', 'LIKE', '%' . $q .'%')
                                    ->get();
                    
                    if(count($category) > 0)
                    return view('category.index')->withDetails($category)->withQuery($q);
                                    
            } 
            
            return "no results found!";

        });