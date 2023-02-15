@extends('master')
@section('title', 'Register page')
@section('main-content')
    <div class="text-center text-primary">
        <h3>Register Details</h3>
    </div>
    <div class="form">
        <form action="{{ url('registerUser') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control">

                @error('name')
                    <div class="error" style="font-size:14px;">{{ '*' . $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control">

                @error('email')
                    <div class="error" style="font-size:14px;">{{ '*' . $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">

                @error('password')
                    <div class="error" style="font-size:14px;">{{ '*' . $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirmed">Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control">

                @error('password_confirmation')
                    <div class="error" style="font-size:14px;">{{ '*' . $message }}</div>
                @enderror
            </div>
            <br>
            <div class="form-group text-center">
                <input type="submit" value="Submit" class="btn btn-success">
                <a href="{{ url('login') }}" class="btn btn-primary btnspace">Login</a>
            </div>
        </form>
    </div>

@endsection
