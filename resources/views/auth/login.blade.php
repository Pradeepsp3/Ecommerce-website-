@extends('master')
@section('title','Login page')
@section('main-content')
@if ($message = Session::get('loginfrombuynow'))
        <div class="alert alert-primary container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="text-center text-primary">
    <h3>LogIn Details</h3>
</div>
    <div class="form">
        <form action="loginAttempt" method="get">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control">
                @error('email')
                    <div class="error">{{ '*' . $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <div class="error">{{ '*' . $message }}</div>
                @enderror
            </div>
            <br>
             <div class="form-group text-center">
                <input type="submit" value="Login" class="btn btn-success">
                <a href="{{ url('register') }}" class="btn btn-primary">New User</a>
            </div>
        </form>
    </div>
@endsection
