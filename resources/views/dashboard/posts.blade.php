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

    <div class="btn-group btn-editing-choice">
     <button value"realtime" id="editor-choice" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Realtime Editing <span class="caret"></span>
     </button>
     <ul class="dropdown-menu">
       <li id="realtime-editing" onclick="RealtimeEditorChoice()">Realtime Editing</li>
       <li id="standalone-editing" onclick="StandaloneEditorChoice()">Standalone Editing</li>
       <li id="collab-publishing" onclick="StandaloneEditorChoice()">Collaborative Publishing</li>
     </ul>
    </div>

    <form class="uk-form uk-form-stacked blog-post-wrapper" id="editing-tools" action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
      <div class="form-wrap">
        <fieldset>
          <div class="form-group" class="post-title">
            <label for="post-title">Title</label>
            <input type="text" class="form-control" id="post-title-input" name="post-title" placeholder="Enter a title">
          </div>

          <label for="firepad">Write your story</label>
          <div id="userlist"></div>
          <div class="form-group" id="firepad">
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
               //// Initialize contents.
               firepad.on('ready', function() {
                 if (firepad.isHistoryEmpty()) {
                   firepad.setText('Write something amazing...');
                 }
               });

               firepad.on('synced', function(isSynced) {
                 document.getElementById("post-body").value = firepad.getText();
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

          <div class="form-group" class="post-read-only">
            <label for="post-body-read-only">RAW Story Markup</label>
            <textarea readonly="readonly" id="post-body" name="post-body"></textarea>
          </div>

          <div class="form-group" name="post-body-standalone"></div> <!-- Standalone editor -->
      </div>

  <div id="post-editor-sidebar">
    <div class="featured-image-widget">
        <div id="image-preview">
            <img src="{{ URL::to('/') }}/uploads/covers/default_cover.png" name="featured_image" class="image-box">
        </div>

        <div id="widget-message">
          Add a cover image
          <i class="ion-arrow-right-c"></i>
          <input type="file" name="featured_image" id="featured_image">
        </div>
      </div>

      <div class="form-group" id="post-tags">
        <label for="post-tags">Associate some tags</label>
        <input type="text" class="form-control" id="post-tags-input" name="post-tags" placeholder="Separate your tags with a comma">
        <div class="<uk-form-select>" data-uk-form-select>
        <span>Suggested tags: </span>
        <select>
        </hr>
          <option value="0">Select from list</option>
          <option value="1">Culture</option>
          <option value="2">Design</option>
          <option value="3">Security</option>
          <option value="4">Politics</option>
          <option value="5">Photography</option>
        </select>
       </div>
      </div>
      </fieldset>
      <button type="submit" class="btn btn-publish">Publish</button>
      <input type="hidden" value="{{ Session::token() }}" name="_token">
    </div>
  </form>
</div>

<script>
setTimeout(function()
{
  document.getElementById("editing-tools").style["-webkit-filter"] = "blur(2px)";
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
  var blurElement = document.getElementById("editing-tools");
  var state = document.getElementById("system-status-link");
  var connectedRef = firebase.database().ref(".info/connected");
  connectedRef.on("value", function(snap) {
  if (snap.val() === true) {
    blurElement.style["-webkit-filter"] = "blur(0px)";
    state.style.color = '#2ab27b';
    state.textContent = "Connected"; 
    UIkit.notify('<span class="ion-checkmark-circled"></span> Connected', 'success');
  } else {
    blurElement.style["-webkit-filter"] = "blur(2px)";
    state.style.color = '#bf5329';
    state.textContent = "Disconnected"; 
    UIkit.notify('<span class="uk-icon-spin ion-load-a"></span> Disconnected: Attempting to reconnect', 'danger');
  }
});
}, 3000);
</script>

<script>
var standaloneEditor = document.getElementById("cke_editor1");
var editingChoice = document.getElementById("editor-choice");
$("cke_editable").attr("id", "default-publishing-editor");
function RealtimeEditorChoice()
{
  editingChoice.innerHTML = "Realtime Editing <span class='caret'></span>";
  editingChoice.setAttribute("value", "realtime");
  standaloneEditor.style.display = "none";
}

function StandaloneEditorChoice()
{
  editingChoice.innerHTML = "Standalone Editing <span class='caret'></span>";
  editingChoice.setAttribute("value", "standalone");
  CKEDITOR.replace( 'post-body-standalone' );
  standaloneEditor.style.display = "block";
  var iframe = document.querySelector("iframe");
  var innerDocument = iframe.contentDocument || iframe.contentWindow.document;
  innerDocument.getElementsByClassName("cke_contents").setAttribute("id", "default-publishing-editor");
}

</script>
@endsection
