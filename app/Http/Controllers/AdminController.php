<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index(){
        return Inertia::render('Admin/index',[
             'categories'=>Category::query()->get(),


        ]);
    }

    public function adminpostsbycategories(){

        // return Post::with('user','category')->paginate(2);
        return Inertia::render('Admin/posts',[
            'categories'=>Category::query()->get(),
            'posts'=>Post::with('category','user')->paginate(10),
        ]);
    }
}
