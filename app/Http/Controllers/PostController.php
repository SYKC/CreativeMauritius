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

     /*
     public function __construct()
     {
         $this->middleware('auth');
     }
     */

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function getPage()
    {
      return view('dashboard.posts');
      $this->middleware('auth');
    }

    public function createPost(Request $request)
    {
      $this->middleware('auth');
      $this->validate($request, [
        'post-title' => 'required',
        'featured_image' => 'image',
      ]);
      $post = new Post;
      $post->title = $request['post-title'];
      $post->body = $request['post-body'];
      $post->featured_image = $request->file('featured_image');;
      $post->tags = $request['post-tags'];
      $post->excerpt_body = $request['post-excerpt'];
      $message = 'An error has occured!';

      //Chmod 777 the image directory for writing images

      if($request->hasFile('featured_image')) {
        $filename = time() . '-' . 'cover' . '.' . $post->featured_image->getClientOriginalExtension();
        $fullPath = public_path('uploads/covers/' . $filename);
        $thumbPath = public_path('uploads/covers/thumbs' . $filename);
        Image::make($post->featured_image->getRealPath())->save($fullPath);
        Image::make($post->featured_image->getRealPath())->resize(150, 80)->save($thumbPath);
        $post->featured_image = $filename;
      } else {
        $post->featured_image = "default_cover.png";
      }

      if ($request->user()->posts()->save($post))
      {
        $message = 'Your article has been successfully published.';
              return redirect()->route('dashboard.posts')->with(['success-message' => $message]);
      } else {
        $message = 'Sorry, an error occurred. Please try again later.';
              return redirect()->route('dashboard.posts')->with(['error-message' => $message]);
      }
    }

    public function readPost($id)
    {
      $this->middleware('guest');
      $getPost = Post::find($id);
      return view('post.read')->with('post', $getPost);
    }

}
