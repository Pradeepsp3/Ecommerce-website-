@extends('master')
@section('title', 'Edit Roles')
@section('main-content')
<div class="text-center text-primary">

    <h2 class="">Edit Role</h2>

</div>
<div class="text-primary" style="display:flex;justify-content:center;">
    <form action={{ url('admin/updateRole/'.$role->id) }} method="post" enctype="multipart/form-data" id="formAction">
        @csrf
        @method('patch')
        <div class="row my-3 col-md-12 align-middle">

            <label for="name" class="h5 text-center">Name</label>
            <input type="text" name="role_name" class="form-control align-middle" value="{{ $role->roles }}">
            @error('role_name')
                <div class="error">{{ '*' . $message }}</div>
            @enderror

        </div>
        <div class="text-center">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('admin/viewRoles') }}" class="btn btn-info">Back</a>
        </div>
    </form>
</div>
@endsection
