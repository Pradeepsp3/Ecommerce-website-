@extends('master')
@section('title', 'My Profile')
<link rel="stylesheet" href="{{ asset('assets/css/myProfile.css') }}">
@section('main-content')
@if ($message = Session::get('profileupdated'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="container rounded bg-white mt-5 mb-5">
        <form action="{{ url('updateProfile/' . $user->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control"
                                placeholder="first name" name='name' value="{{ $user->name }}"></div>
                                @error('name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mobile Number</label><input type="text"
                                class="form-control" name='phone' placeholder="enter phone number" value="{{ $user->phone }}"></div>
                                @error('phone')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                        <div class="col-md-6"><label class="labels">Email ID</label><input type="text"
                                class="form-control" name='email' placeholder="enter email id" value="{{ $user->email }}"></div>
                                @error('email')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text"
                                class="form-control" name='address' placeholder="enter address line 1" value="{{ $user->address }}"></div>
                                @error('address')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                        <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text"
                                class="form-control" name='address1' placeholder="enter address line 2" value="{{ $user->address2 }}"></div>
                                @error('address2')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">City</label><input type="text" class="form-control"
                                name='city' placeholder="city" value="{{ $user->city }}"></div>
                                @error('city')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                        <div class="col-md-6"><label class="labels">State</label><input type="text" class="form-control"
                                value="{{ $user->state }}" name='state' placeholder="state"></div>
                                @error('state')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                class="form-control" name='country' placeholder="country" value="{{ $user->country }}"></div>
                                @error('country')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                        <div class="col-md-6"><label class="labels">zipcode</label><input type="text"
                                class="form-control" value="{{ $user->zipcode }}" name='zipcode' placeholder="zipcode"></div>
                                @error('zipcode')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                    </div>
                    <div class="mt-5 text-center"><input type="submit" class="btn btn-primary profile-button" value="Save Profile"></div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
@endsection
