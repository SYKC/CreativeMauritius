<?php

namespace creativemauritius\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use creativemauritius\Models\Post;
use creativemauritius\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Route;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index() {
       $posts = Post::all();
       $username = Auth::user()->username;
       if (Auth::user()->id === 0) {
         return redirect()->route('user.profile', [$username]);
       }
       else {
         return view('dashboard.admin', ['posts' => $posts]);
       }
     }

     public function getMedia()
     {
       $posts = Post::all();
       return view('dashboard.media', ['posts' => $posts]);
     }

     public function getWrittenPosts()
     {
       $posts = Post::all();
       return view('dashboard.written', ['posts' => $posts]);
     }

     public static function getRoutes()
     {
       $count = 0;
       $routeCollection = Route::getRoutes();
       foreach ($routeCollection as $value) {
         $count = $count + 1;
       }
       echo $count;
     }

}
