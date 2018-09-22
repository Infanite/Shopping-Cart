@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <h1>Sign In</h1>
    @if(count($errors) > 0)
      <div class="alert alert-danger">
         @foreach ($errors->all() as $error)
           <p>{{ $error }}</p>
         @endforeach
      </div>
    @endif
    <form action="{{ route('user.login') }}" method="post">
      <div class="form-group">
        <label for="email">E-Mail</label>
        <input type="text" name="email" class="form-control">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" >
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
       {{ csrf_field() }}
    </form>
     <p>Don't have an account? <a href="{{ route('user.signup') }}">Sign up instead!</a> </p>
  </div>
</div>
@endsection
