@extends('layouts.admin')
@section('content')
  <div class="container" id="admin-panel">
    <h3>Media library</h3>
    @foreach($posts as $post)
      <img class="media-library-wrap" src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}">
    @endforeach
  </div>
@endsection
