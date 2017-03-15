@extends('layouts.app')
@section('content')
  <div class="blog-post-container" id="main-wrapper">
    <article role="main">
      <section id="article-header">
        <header id="title" data-description="{{ $post->tags }}">
          <h1 class="article-title">{{ $post->title }}</h1>
        </header>
      </section>

      @if ($post->featured_image != "default_cover.jpg")
        <div class="post-cover-bg">
          <figure>
            <img src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}" class="img-cover" alt="{{ $post->title }}">
          </figure>
        </div>
      @else
        <!-- Add an overlapping div with a {category} text displayed over image-->
        <img src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}" class="img-cover" alt="{{ $post->title }}">
      @endif

      <div class="row">
        <div class="col-md-3">.col-md-4</div>
        <div class="col-md-6">
          <section id="article-body">
            <p>{{ $post->body }}</p>
          </section>
        </div>
        <div class="col-md-3">.col-md-4</div>
      </div>
    </article>
  </div>
@endsection
