@extends('master')
@section('title', 'View Categories')
@section('main-content')
<div class="text-center text-primary">
    <br>
    <h3>Categories List</h3>
    <br>
</div>
    <div class="col-md-8 container d-flex align-items-center justify-content-center">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td><a href="{{ url('admin/edit/'.$category->id) }}" class="btn btn-warning">Edit</a> <a href="{{ url('admin/delete/'.$category->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection