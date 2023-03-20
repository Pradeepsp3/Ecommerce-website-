@extends('master')
@section('title', 'View Roles')
@section('main-content')

    <div class="text-center text-primary">
        <br>
        <h3>Roles List</h3>
        <br>
    </div>
    @if ($message = Session::get('roleUpdated'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('roleDeleted'))
        <div class="alert alert-danger container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-8 container">
        <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewRoles') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control">
                    <input type="submit" value="search" class="btn btn-primary">
                </div>
            </form>
        </div>
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>Roles</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->roles }}</td>
                        <td><a href="{{ url('admin/editRole/' . $role->id) }}" class="btn btn-warning editRole"
                                id="roleId">Edit</a> <a href="{{ url('admin/deleteRole/' . $role->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
