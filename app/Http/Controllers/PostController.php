<?php

namespace creativemauritius\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;
use creativemauritius\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Route;

class PostController extends Controller
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
      return view('dashboard.posts');
    }

    public function createPost(Request $request)
    {
      $this->validate($request, [
        'post-title' => 'required',
        'post-body' => 'required',
        'featured_image' => 'image',
      ]);
      $post = new Post;
      $post->title = $request['post-title'];
      $post->body = $request['post-body'];
      $post->featured_image = $request->file('featured_image');;
      $post->tags = $request['post-tags'];
      $message = 'An error has occured!';

      //Chmod 777 the image directory for writing images

      if($request->hasFile('featured_image')) {
        $filename = time() . '-' . 'cover' . '.' . $post->featured_image->getClientOriginalExtension();
        $path = public_path('uploads/covers/' . $filename);
        Image::make($post->featured_image->getRealPath())->resize(200,200)->save($path);
        $post->featured_image = $filename;
      } else {
        $post->featured_image = "http://webapp.com/uploads/covers/default_cover.jpg";
      }

      if ($request->user()->posts()->save($post))
      {
        $message = 'Your article has been successfully published.';
      }
      return redirect()->route('dashboard.posts')->with(['message' => $message]);
    }

}
