@extends('layouts.app')
@section('content')
  <div class="homepage-impression">
    <h1>Hello</h1>
  </div>
<div class="container" id="container-top">
<h1 class="site-title">{{ config('app.name', 'Creative Mauritius') }}</h1>
<p id="tagline">
  Discover
  <span class="underline">art</span>,
  <span class="underline">culture</span>,
  <span class="underline">history</span>,
  <span class="underline">talent</span>
</p>
</div>
<div class="container">
  <div class="featured-moments">
    <h1>Featured</h1>
      <hr>
      <div class="moment-info">
        <span class="attribute"><strong> Title: </strong> Collect moments, not things.</span>
        <span class="attribute"><strong> Posted by: </strong> khaydendarkiss </span>
    </div>

      <button id="learn-more">View moment</button>
  </div><!--end of featured-->

<div class="categories">
  <div class="ui-options-wrapper">
      <h5 id="order-by"><span class="ion-navicon-round"></span> Order by</h5>
      <h5 id="add-tags"><span class="ion-plus-round"></span> Add your own tags</h5>
  </div>
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
