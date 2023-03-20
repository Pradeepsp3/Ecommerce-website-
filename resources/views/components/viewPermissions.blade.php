@extends('master')
@section('title', 'Add and view Permissions')
@section('main-content')
<div>
    <div class="text-center text-primary">
        <h2 class="">Add Permissions</h2>
    </div>
    @if ($message = Session::get('permissionAdded'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-primary" style="display:flex;justify-content:center;">
        <form action="{{ url('admin/storePermission') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row my-3 col-md-12 align-middle">

                <label for="name" class="h5 text-center">Name</label>
                <input type="text" name="permission" class="form-control align-middle" placeholder="permissions name">
                @error('permission')
                    <div class="error" style="font-size:14px">{{ '*' . $message }}</div>
                @enderror

            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</div>
<hr class="hr"/>
<div>
    <div class="text-center text-primary">
        <br>
        <h3>Permissions List</h3>
        <br>
    </div>
    @if ($message = Session::get('permissionUpdated'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('permissionDeleted'))
        <div class="alert alert-danger container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-8 container">
        <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewPermissions') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control">
                    <input type="submit" value="search" class="btn btn-primary">
                </div>
            </form>
        </div>
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>Permissions</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->permissions }}</td>
                        <td><a href="{{ url('admin/editPermission/' . $permission->id) }}" class="btn btn-warning editpermission"
                                id="permissionId">Edit</a> <a href="{{ url('admin/deletePermission/' . $permission->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $permissions->links() !!}
        </div>
    </div>
</div>
@endsection
