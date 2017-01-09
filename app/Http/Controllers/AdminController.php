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
       $username = Auth::user()->username;
       if (Auth::user()->id !== 10) {
         return redirect()->route('user.profile', [$username]);
       }
       else {
         return view('dashboard.admin');
       }
     }

     public function getMedia()
     {
       $post = new Post;
       return view('dashboard.media');
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
