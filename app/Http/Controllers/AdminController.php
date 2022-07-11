<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

    public function usercreate(){
          return Inertia::render('Admin/usercreate',[
            'roles'=>Role::query()->get(),
          ]);
    }
    public function userstore(UserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'slug'=>Str::slug($request->name),
             'role_id'=>$request->role_id,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
        ]);
       $user->save();
       return redirect()->back()->with('message','User has been created.Please inform the user to verify his/her email');
       event(new Registered($user));


    }
}
