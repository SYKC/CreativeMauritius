@extends('layouts.admin')
@section('content')
  @include('includes.alerts')
  <div class="container" id="admin-panel">
    @if(Session::has('success-message'))
      <div class="success-message"><span class="ion-ios-checkmark-outline"></span> {{ session('success-message') }}</div>
    @endif

    @if(Session::has('error-message'))
      <div class="error-message"><span class="ion-ios-close-outline"></span> {{ session('error-message') }}</div>
    @endif
    <form class="uk-form uk-form-stacked blog-post-wrapper" action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
      <div class="form-wrap">
        <fieldset>
          <div class="uk-form-row" id="post-title">
            <label class="uk-form-label" for="post-title">Title</label>
            <input type="text" class="uk-form-controls" id="post-title-input" name="post-title" placeholder="Enter a title">
          </div>

          <div class="uk-form-row" id="post-editor">
            <label class="uk-form-label" for="post-body">Write your story</label>
            <textarea name="post-body" data-uk-htmleditor="{markdown:true}" id="editable"></textarea>
          </div>
      </div>

  <div id="post-editor-sidebar">
    <div class="featured-image-widget">
        <div id="image-preview">
            <img src="{{ URL::to('/') }}/uploads/covers/default_cover.jpg" name="featured_image" class="image-box">
        </div>

        <div id="widget-message">
          Add a cover image
          <i class="ion-arrow-right-c"></i>
          <input type="file" name="featured_image" id="featured_image">
        </div>
      </div>

      <div class="uk-form-row" id="post-tags">
        <label class="uk-form-label" for="post-tags">Associate some tags</label>
        <input type="text" class="uk-form-controls" id="post-tags-input" name="post-tags" placeholder="Separate your tags with a comma">
      </div>
      </fieldset>
      <button type="submit" class="uk-button btn-publish">Publish</button>
      <input type="hidden" value="{{ Session::token() }}" name="_token">
    </div>
  </form>
</div>
@endsection
