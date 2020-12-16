@extends('layouts/layout')
@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
    <a class="navbar-brand " href="{{url('/')}}">Bus Booking</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0" style="padding-left:40rem;" >
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">about</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">contacts</a>
          </li>
          @if(Auth::user())

          <li class="nav-item">
            <a class="nav-link link text-white" href="{{url('/logout')}}">Logout</a>
          </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{url('/login')}}"><i class='fas fa-user-alt' style='font-size:25px'></i>
            </a>
          </li>

</li>
@endif
        
        
        </ul>
      
      </div>
    </div>
  </nav>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

@endsection