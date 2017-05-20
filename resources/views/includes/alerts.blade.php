@if (Session::has('message'))
  {{ Session::get('message') }}
@endif

@if (count($errors) > 0)
<script type="text/javascript">
    console.log(location.hash);//here double curly bracket
</script>
  @foreach ($errors->all() as $error)
    <div class="error-message" uk-alert>
      <a class="uk-alert-close" uk-close></a>
      {{ $error }}
    </div>

  @endforeach
@endif
