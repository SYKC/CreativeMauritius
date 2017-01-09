@if (Session::has('message'))
  {{ Session::get('message') }}
@endif

@if (count($errors) > 0)
  @foreach ($errors->all() as $error)
    <li>
      {{ $error }}
    </li>
  @endforeach
@endif
