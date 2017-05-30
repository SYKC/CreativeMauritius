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
<div class="container">
  <div class="featured-container">
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

      <h5 id="tags"></span> Featured</h5>

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
</div><!--categories-->
</div><!--container-->
@endsection
