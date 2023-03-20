@extends('master')
@section('title', 'Edit Permissions')
@section('main-content')
<div>
    <div class="text-center text-primary">
        <h2 class="">Edit Permissions</h2>
    </div>
    {{-- @if ($message = Session::get('permissionAdded'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}

    <div class="text-primary" style="display:flex;justify-content:center;">
        <form action="{{ url('admin/updatePermission/'.$permission->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row my-3 col-md-12 align-middle">

                <label for="name" class="h5 text-center">Name</label>
                <input type="text" name="permission" class="form-control align-middle" placeholder="{{ $permission->permissions }}">
                @error('permission')
                    <div class="error" style="font-size:14px">{{ '*' . $message }}</div>
                @enderror

            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                <a href="{{ url('admin/viewPermissions') }}" class= "btn btn-info">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
