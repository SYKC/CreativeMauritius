<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Route;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         //$this->middleware('auth');
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
      $user = User::where('email', '=', Input::get('email'))->first();
      if (!Auth::check()) {
        $this->middleware('guest');
        return view('user.profile')->with('user', $user);
      } else
      {
        $this->middleware('auth');
        return view('user.profile')->with('user', $user);
      }
    }

    public function getProfileUpdate()
    {
      $this->middleware('auth');
      if (Auth::user()->username !== Route::Input('username')) {
        # code...
        return dd('Nice try, LOL!');
      } else {
        return view('user.edit');
      }
    }

    public function postProfileUpdate(Request $request)
    {
      $username = Auth::user()->username;
      $user = User::where('email', '=', Input::get('email'))->first();
      $avatar = $request->file('avatar');

      if($request->hasFile('avatar')) {
        $filename = $username . '-' . time() . '-' . 'avatar' . '.' . $avatar->getClientOriginalExtension();
        $path = public_path('uploads/avatars/' . $filename);
        Image::make($avatar)->resize(200,200)->save($path);
        $user->avatar = $filename;
        $user->save();

        if (Auth::user()->avatar != "default.jpg") {
          $path = '/uploads/avatars/';
          $lastpath= Auth::user()->avatar;
          File::Delete(public_path( $path . $lastpath) );
        }
      }

      $this->validate($request, [
        'name' => ['regex:/^[(a-zA-Z\s)]+$/u'],
        'location' => ['regex:/^[(a-zA-Z\s)]+$/u'],
        'email' => 'email|max:255|unique:users',
        'biography' => 'max:250',
        'avatar' => 'image',
      ]);

      Auth::user()->update([
        'name' => $request->input('name'),
        'location' => $request->input('location'),
        'email' => $request->input('email'),
        'biography' => $request->input('biography'),
      ]);

      return redirect()->route('user.edit', $username);
    }
}
