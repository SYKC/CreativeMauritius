@extends('layouts.app')

@section('content')
<div class="container" id="container-top-profile">
  @if(Auth::check() && ( Route::Input('username') === Auth::user()->username ))
    <p id="welcome-message">
      Hello, {{ Auth::user()->first_name }}
    </p>
    <a href="{{ route('user.edit', auth::user()->username) }}"><button id="edit">Edit Profile</button></a>
  @endif
  <div class="profile-container">
    @if(Auth::check() && ( Route::Input('username') === Auth::user()->username ))
      <img class="user-avatar" src="{{ URL::to('/') }}/uploads/avatars/{{ Auth::user()->avatar}}" alt="{{ Route::Input('name') }}" />
      <p>
        Username: {{ Auth::user()->username }}
      </p>
      <p>
        Location: {{ Auth::user()->location }}
      </p>
      <p>
        Email: {{ Auth::user()->email }}
      </p>
      <p id="user-id">
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
