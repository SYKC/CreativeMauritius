<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;

class UploadController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function UserUpload(Request $request)
    {
      $upload = new Upload();
      $upload = $request['caption'];
      $request->user()->uploads()->save($upload);
        return redirect()->route('home');
    }
}
