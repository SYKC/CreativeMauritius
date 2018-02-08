@extends('layouts.app')
@section('content')
  <div class="blog-post-container">
    <article role="main">
      <section id="article-header">
        <header id="title" data-description="{{ $post->tags }}">
          <h1 class="article-title">{{ $post->title }}</h1>
        </header>
      </section>

      @if ($post->featured_image != "default_cover.png")
        <div class="post-cover-bg">
          <figure>
            <img src="{{ url('/') }}/uploads/covers/{{ $post->featured_image }}" class="img-cover" alt="{{ $post->title }}">
          </figure>
        </div>
      @else
        <!-- Add an overlapping div with a {category} text displayed over image-->
        <img src="{{ url('/') }}/uploads/covers/{{ $post->featured_image }}" class="img-cover" alt="{{ $post->title }}">
      @endif

      <div class="row main-content-wrapper">
        <aside class="article-metadata-container col-md-3">
         <span>Written by</span>
         <img class="author-avatar" src="{{ url('/') }}/uploads/avatars/{{ $post->user->avatar }}">
         <p class="author-name">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
         <span class="icon">
          <i class="ion-calendar"> 27 MAY 2017</i>
        </span>
        </aside><!-- End of right sidebar -->
        <div class="col-md-6">
          <section id="article-body">
            <p>{!! $post->body !!}</p>
          </section>
        </div>
        <aside class="col-md-3">.col-md-4</aside><!-- End of left sidebar -->
      </div>
    </article>
  </div>
@endsection
