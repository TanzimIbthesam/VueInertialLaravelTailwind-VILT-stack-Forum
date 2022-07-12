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

Route::get('myprofile',[UserController::class,'profile'])->name('myprofile')->middleware('auth');
Route::get('authuserposts',[UserController::class,'usersposts'])->middleware('auth');
Route::get('/admin',[AdminController::class,'index'])->name('admin')->middleware('auth','can:onlyadmin');
Route::get('/adminposts',[AdminController::class,'adminpostsbycategories'])->name('admin.posts')->middleware('auth','can:onlyadmin');

Route::get('/adminusercreate',[AdminController::class,'usercreate'])->name('admin.creatuser')->middleware('auth','can:onlyadmin');
Route::post('/adminuserstsore',[AdminController::class,'userstore'])->name('admin.usersstore')->middleware('auth','can:onlyadmin');

Route::post('/updateprofile',[UserController::class,'profileupdate'])->name('profile.update')->middleware('auth');

Route::resource('categories',CategoryController::class);
 Route::get('categories/create',[CategoryController::class,'create'])
 ->name('categories.create')->middleware('auth','can:onlyadmin');

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
