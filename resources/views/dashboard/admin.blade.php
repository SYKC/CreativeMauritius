@extends('layouts.admin')
@section('content')
  <div class="container" id="admin-panel">
    <h5>
      Network Status:
    </h5>
    <span class="status-online">ONLINE</span>

    <p class="total-users">
      Total Users:
      <span>{{ creativemauritius\Models\User::getAllUsers() }}</span>
    </p>
    @foreach($posts as $post)
      <h3>
        {{ $post->title }}
      </h3>
      <img src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}">
    @endforeach
  </div>
@endsection
