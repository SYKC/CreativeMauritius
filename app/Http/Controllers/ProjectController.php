<?php

namespace creativemauritius\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;
use creativemauritius\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Route;

class ProjectController extends Controller
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
     public function getPage()
    {
      return view('dashboard.projects.index');
    }

}
