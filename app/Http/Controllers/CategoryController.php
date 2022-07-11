<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
    public function index()
    {
        //
        return Category::query()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return new CategoryCollection(Category::query()->paginate(10));
        return Inertia::render('Category/create',[
            'categories'=>new CategoryCollection(Category::query()->paginate(10)),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        $category=new Category();
        $category->name=$request->input('name');
        $category->slug=Str::slug($category->name);
        $category->save();
        return Redirect::route('categories.create')->with('message','Your category has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {

        return Inertia::render('Category/show',[
                // 'postsByCategory'=>Category::findorFail($id)->posts
                 'postsByCategory'=>Category::where('slug',$category)->with('posts')->first()

        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        //
        return Inertia::render('Category/edit',[
            'category'=>Category::where('slug',$category)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category=Category::find($id);
        $category->name=$request->input('name');
        $category->update();
        return Redirect::route('categories.create')->with('message','Your category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category=Category::find($id);
        $category->delete();
        return Redirect::route('categories.create')->with('message','Your category has been deleted');
    }
}
