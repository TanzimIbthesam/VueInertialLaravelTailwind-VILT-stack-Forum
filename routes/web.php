<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryBladeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/',[PostController::class,'index'])->name('home');
Route::get('/test/home',function(){
    return view('test');
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin',[AdminController::class,'index'])->name('admin')->middleware('auth','can:createcategory');
Route::get('/adminposts',[AdminController::class,'adminpostsbycategories'])->name('admin.posts')->middleware('auth','can:createcategory');

Route::resource('categories',CategoryController::class);
 Route::get('categories/create',[CategoryController::class,'create'])->middleware('auth','can:createcategory')->name('categories.create');

Route::resource('post',PostController::class);
Route::resource('user',UserController::class);
Route::resource('comment',CommentController::class);
Route::get('test',function(){
      return Inertia::render('Category/test');
});
//  Route::get('categories/{category:slug}',[CategoryController::class,'show']);
Route::get('/test',function(){
    return Inertia::render('Category/test');
})->middleware('auth','can:createcategory');

require __DIR__.'/auth.php';
