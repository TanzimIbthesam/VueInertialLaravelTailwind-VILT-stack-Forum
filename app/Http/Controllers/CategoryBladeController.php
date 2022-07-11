<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryBladeController extends Controller
{
    //
   public function index(){
    $categories=Category::all();
    return view('categories.index',compact('categories'));
   }
}
