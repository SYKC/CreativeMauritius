@extends('layouts.admin')
@section('content')
  <div class="container" id="admin-panel">
    <h5>
      Network Status:
    </h5>
    <span class="status-online">ONLINE</span>

    <p class="total-users">
      Total Users:
      <span>{{ creativemauritius\Models\User::getAllUsers() }}</span>
    </p>
  </div>
@endsection
