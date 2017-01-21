@extends('layouts.admin')
@section('content')
  <div class="container">
      <h1>Posts</h1>
    <table id="posts_table" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Tags</th>
            <th>Posted by</th>
        </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->tags }}</td>
          <td>{{ $post->user->username }}</td>
        </tr>
      @endforeach
    </tbody>
</table>
  </div>
@endsection
