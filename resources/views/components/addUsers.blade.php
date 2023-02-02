@extends('master')
@section('title', 'Add Users')
@section('main-content')
    <div class="text-center text-primary">

        <h2 class="">Add User</h2>

    </div>

    <div class="text-primary container" style="padding-bottom:100px;">
        <form action="{{ url('admin/storeUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="align-middle">
                <label for="name" class="h5">Name</label>
                <input type="text" name="name" class="form-control align-middle" placeholder="Name">
                @error('name')
                    <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                @enderror
            </div>
            <div class="row my-3">
                <div class="col col-md-6">
                    <label for="email" class="h5">Email</label>
                    <input type="text" name="email" class="form-control align-middle" placeholder="email">
                    @error('email')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <div class="col col-md-6">
                    <label for="phone" class="h5">Phone</label>
                    <input type="text" name="phone" class="form-control align-middle" placeholder="phone">
                    @error('phone')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="">
                <label for="role" class="h5 form-label">User Role</label>
                <select name="role" id="" class="form-control">
                    <option value="" selected disabled>Select a Role</option>
                    <option value="0">Customer</option>
                    <option value="1">Admin</option>
                </select>
                @error('role')
                    <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                @enderror
            </div>
            <div class=" row my-3">
                <div class=" col col-md-6">
                    <label for="password" class="h5">Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <div class=" col col-md-6">
                    <label for="confirmed" class="h5">Confirm Password</label>
                    <input type="text" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-12">
                    <label for="address" class="h5">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="1234 Main St">
                    @error('address')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="address2" class="h5">&nbsp;</label>
                    <input type="text" class="form-control" name="address2" placeholder="Apartment, studio, or floor">
                    @error('address2')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class=" col col-md-6">
                    <label for="city" class="h5">City</label>
                    <input type="text" class="form-control" name="city">
                    @error('city')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <div class=" col col-md-6">
                    <label for="state" class="h5">State</label>
                    <input type="text" class="form-control" name="state">
                    @error('state')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class=" col col-md-6">
                    <label for="country" class="h5">Country</label>
                    <input type="text" class="form-control" name="country">
                    @error('country')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <div class=" col col-md-6">
                    <label for="zipcode" class="h5">Zipcode</label>
                    <input type="text" class="form-control" name="zipcode">
                    @error('zipcode')
                        <div class="text-danger" style="font-size:14px;">{{ '*' . $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="text-center" style="margin-top:10px;">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
@endsection
