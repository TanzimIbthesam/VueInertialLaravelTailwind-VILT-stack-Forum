<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->middleware('auth')->except('index','show');
        //  $this->middleware('log')->only('create','edit');
    }
    public function index(Request $request,Post $post,User $user)
    {



        return Inertia::render('Posts/index',[
            'posts'=>Post::with('user','category')->paginate(10),


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return Inertia::render('Posts/create',[
            'categories'=>Category::query()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $post=new Post();
        $post->title=$request->input('title');
        $post->description=$request->input('description');
        $post->slug=Str::slug($post->title);
        $post->user_id=$request->user()->id;
        $post->category_id=$request->input('category_id');
        if($request->hasFile('image')){
            //Image upload
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;

            $request->file('image')->storeAs('public/product_images',$fileNameToStore);




                    $post->image = $fileNameToStore;



            $post->save();
            return Redirect::route('post.create')->with('message','Your post has been posted');

    }else{



                $post->image = null;



        $post->save();
         return Redirect::route('post.create')->with('message','Your post has been posted');

    }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($post)
    {





        // return Post::where('slug',$post)->with('user','comments.user')->firstOrFail();
        // return new PostResource(Post::where('slug',$post)->with('user')->firstOrFail());
        return Inertia::render('Posts/PostDetail',[
             'post'=>new PostResource(Post::where('slug',$post)->with('user','comments')->firstOrFail())
          ]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        //return Posts::where('slug',$post)->with('category','user')->firstorFail();
        return Inertia::render('Posts/EditPost',[
            'categories'=>Category::query()->get(),

            'post'=>Posts::where('slug',$post)->with('category','user')->firstorFail()
          ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        //
        $post=Posts::find($id);
        $post->title=$request->input('title');
        $post->description=$request->input('description');
        $post->category_id=$request->input('category_id');
        $post->update();
        return Redirect::route('post.index')->with('message','Your post has been updated');


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
        $post=Post::find($id);
        if($post->image != null){
            // Delete Image
            Storage::delete('public/product_images/'.$post->image);
        }

        $post->delete();
        return redirect()->back()->with('message','Your Post has been deleted');
    }
}
