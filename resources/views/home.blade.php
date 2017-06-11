@extends('layouts.app')
@section('content')

  <div class="homepage-impression">
    <section class="showcase-container">
      <h1>Welcome</h1>
    </section>
  </div>


<div class="container" id="container-top">
<h1 class="site-title">{{ 'Creative • Mauritius' }}</h1>
<p id="tagline">
  Discover
  <span class="underline">art</span>,
  <span class="underline">culture</span>,
  <span class="underline">history</span>,
  <span class="underline">talent</span>
</p>
</div>
<div class="homepage-container">
  <div class="featured-container">
    <h5 id="featured-container-tag"></span> Featured</h5>
    <span class="attribute"> ADVENTURE | STORY </span>
    <h1>The Cinematography of “Anna Karenina”</h1>
      <hr>
      <div class="article-excerpt">
        <p>
          Director of photography Seamus McGarvey’s collaborative history with Joe Wright goes back years, and he had worked with most of the Anna Karenina filmmaking team on Atonement.
        </p>
    </div>

      <button id="learn-more">Read More <span class="ion-chevron-right"></span></button>
  </div><!--end of featured-->

  <!-- Start of full width container -->
  <section class="full-width-container">
    <div class="layout-2-1-sidebar">
     <div class="col-md-8 article-full-cover">
     @foreach($posts->sortByDesc('id')->slice(0,1) as $post)
     <img class="responsive-media" src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}">
      <div class="article-details-overlay">
      <span class="category">Cultural Origins</span>
        <span class="article-author">
         A story by
         <img class="author-avatar" src="{{ URL::secure('/') }}/uploads/avatars/{{ $post->user->avatar }}">
         {{ $post->user->name }}</span>
        <h1>{{ $post->title }}</h1>
     @endforeach
      </div>
     </div>

     <div class="col-md-4 staff-picks-sidebar">
      <div class="staff-picks-container">
       <label class="staff-picks">STAFF PICKS</label>
       @foreach($posts->sortByDesc('id')->slice(0,6) as $post)
       <p>{{ $post->title}}</p>
       @endforeach
      </div>
     </div>
    </div>
  </section>

  <div class="row">
      @foreach($posts->sortByDesc('id')->slice(0,2) as $post)
       <div class="home-new-article-card col-md-4">
       <span class="hidden-metadata" data-description="{{  $post->tags }}"></span>
         <img class="featured-image-wrapper" src="{{ URL::secure('/') }}/uploads/covers/{{ $post->featured_image }}">
         <div class="article-card-excerpt">
          <h2>{{ $post->title}}</h2>
          <p>{{ substr($post->body, 0, 200) }}...</p>
         </div>
       </div>
      @endforeach
      <div class="home-new-article-card col-md-8"> 
      <h1>ARTICLE</h1>
      </div>
  </div>
<!--
<div class="categories">
  <div class="category-grid" id="decisive">
    <h3>Decisive</h3>
  </div>

  <div class="category-grid" id="important">
    <h3>Important</h3>
  </div>

  <div class="category-grid" id="memorable">
    <h3>Memorable</h3>
  </div>

  <div class="category-grid" id="unique">
    <h3>Unique</h3>
  </div>
</div>
-->
</div><!--container-->
@endsection
