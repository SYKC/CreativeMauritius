@extends('layouts.admin')
@section('content')
<div class="container center" id="admin-panel">
    <h3>Media library</h3>
    @foreach($posts as $post)
    <div class="container col-md-3">
      <img class="media-library-wrap" src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}">
    </div>
    @endforeach
</div>
@endsection
