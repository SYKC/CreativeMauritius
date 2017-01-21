@extends('layouts.admin')
@section('content')
  <div class="container" id="admin-panel">
    <h3>Media library</h3>
    @foreach($posts as $post)
      <img class="media-library-wrap" src="http://webapp.com/uploads/covers/{{ $post->featured_image }}">
    @endforeach
  </div>
@endsection
