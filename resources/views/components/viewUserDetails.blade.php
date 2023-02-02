@extends('master')
@section('title', 'View User Details')
@section('main-content')
<div class="text-center text-success">
    <br>
    <h3>Details for <span class="text-success">{{ $user->name }}</span></h3>
    <br>
</div>
<div class="container">
    <table class="table table-bordered text-center align-middle">
        <tbody>
            <tr>
                <th class="font-weight-bold" colspan="2">User Id</th>
                <td colspan="2">{{ $user->id }}</td>
            </tr>
            <tr>
                <th colspan="2">Name</th>
                <td colspan="2">{{ $user->name }}</td>
            </tr>
            <tr>
                <th colspan="2">Email</th>
                <td colspan="2">{{ $user->email }}</td>
            </tr>
            <tr>
                <th colspan="2">Contact No</th>
                <td colspan="2">{{ $user->phone }}</td>
            </tr>
            <tr>
                <th colspan="2">User Role</th>
                @if ($user->role_as == "1")
                <td colspan="2">Admin</td>
                @else
                <td colspan="2">Customer</td>
                @endif

            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3">{{ $user->address.", ".$user->address2 }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $user->city }}</td>
                <th>State</th>
                <td>{{ $user->state }}</td>
            </tr>
            <tr>
                <th>Country</th>
                <td>{{ $user->country }}</td>
                <th>Zipcode</th>
                <td>{{ $user->zipcode }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    <a href="{{ url('admin/viewUsers') }}" class="btn btn-info">Back</a>
</div>
@endsection
