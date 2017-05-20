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

    <span class="system-status">System status: <a id="system-status-link">Checking...</a></span>

    <form class="uk-form uk-form-stacked blog-post-wrapper" action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
      <div class="form-wrap">
        <fieldset>
          <div class="uk-form-row" class="post-title">
            <label class="uk-form-label" for="post-title">Title</label>
            <input type="text" class="uk-form-controls" id="post-title-input" name="post-title" placeholder="Enter a title">
          </div>

          <div id="userlist"></div>
          <div class="uk-form-row" id="firepad" name="post-body">
            <label class="uk-form-label" for="firepad">Write your story</label>
              <script>
    function init() {
      //// Initialize Firebase.
      //// TODO: replace with your Firebase project configuration.
      var config = {
        apiKey: "AIzaSyB4hyq5hxawaZ1z3T5ZkgjSy2GcFh4Ku8k",
        authDomain: "creativemauritius-60b84.firebaseapp.com",
        databaseURL: "https://creativemauritius-60b84.firebaseio.com"
      };
      firebase.initializeApp(config);
      //// Get Firebase Database reference.
      var firepadRef = getExampleRef();
      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad'), { lineWrapping: true });
      // Create a random ID to use as our user ID (we must give this to firepad and FirepadUserList).
      var userId = Math.floor(Math.random() * 9999999999).toString();
      //// Create Firepad (with rich text features and our desired userId).
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true, userId: userId});
      //// Create FirepadUserList (with our desired userId).
      var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'),
          document.getElementById('userlist'), userId);
      //// Initialize contents.
      firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setText('Check out the user list to the left!');
        }
      });
    }
    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() {
      var ref = firebase.database().ref();
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key; // add it as a hash to the URL.
      }
      if (typeof console !== 'undefined') {
        console.log('Firebase data: ', ref.toString());
      }
      return ref;
    }
  </script>
  
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
        <script>
    setTimeout(function()
    {
        var articleBox = document.querySelector("textarea");
        articleBox.setAttribute("id", "post-body");
        articleBox.setAttribute("name", "post-body"); 
    }, 2000);
</script>

<script>
setTimeout(function()
{
  UIkit.notify('<span class="uk-icon-spin ion-load-a"></span> Connecting...', 'warning');
}, 1000)

setTimeout(function()
{
  if (document.getElementById("system-status-link").innerHTML === "Checking...") {
     UIkit.notify('An error occurred, please reload this page.', 'warning');
  }
}, 5000)

setTimeout(function()
{
  var state = document.getElementById("system-status-link");
  var connectedRef = firebase.database().ref(".info/connected");
  connectedRef.on("value", function(snap) {
  if (snap.val() === true) {
    state.style.color = '#2ab27b';
    state.textContent = "Connected"; 
    UIkit.notify('<span class="ion-checkmark-circled"></span> Connected', 'success');
  } else {
    state.style.color = '#bf5329';
    state.textContent = "Disconnected"; 
    UIkit.notify('<span class="uk-icon-spin ion-load-a"></span> Disconnected: Attempting to reconnect', 'danger');
  }
});
}, 3000);
</script>
@endsection
