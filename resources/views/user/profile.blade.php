@extends('layouts.app')

@section('content')
<div class="container">
  @if(Auth::check() && ( Route::Input('username') === Auth::user()->username ))
    <p>
      Hello, {{ Auth::user()->name }}
    </p>
    <a href="{{ route('user.edit', auth::user()->username) }}"><button id="edit">Edit Profile</button></a>
  @endif
  <div class="profile-container">
    @if(Auth::check() && ( Route::Input('username') === Auth::user()->username ))
      <img class="user-avatar" src="{{ URL::to('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Route::Input('name') }}" />
      <p>
        Username: {{ Auth::user()->username }}
        Location: {{ Auth::user()->location }}
        Email: {{ Auth::user()->email }}
        {{ Auth::user()->id }}
      </p>
    @else
      <p>
        This is {{ Route::Input('username') }}'s profile
      </p>

      <img class="user-avatar" src="{{ URL::to('/') }}/uploads/avatars/default.jpg" alt="{{ Route::Input('name') }}" />
    @endif
  </div>
</div>
@endsection
