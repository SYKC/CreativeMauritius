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
          <td>
            <p>{{ $post->title }}</p>
            <a href="/article/{{$post->id}}" class="edit-editable-post">Edit</a>
            <a href="/article/{{$post->id}}" class="view-editable-post">View Article</a>
          </td>
          <td>{{ $post->tags }}</td>
          <td>{{ $post->user->username }}</td>
        </tr>
      @endforeach
    </tbody>
</table>
  </div>
@endsection
