@extends('master')
@section('title', 'View Categories')
@section('main-content')

    <div class="text-center text-primary">
        <br>
        <h3>Categories List</h3>
        <br>
    </div>
    @if ($message = Session::get('categoryUpdated'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('categoryDeleted'))
        <div class="alert alert-danger container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-8 container">
        <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewCategories') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control">
                    <input type="submit" value="search" class="btn btn-primary">
                </div>
            </form>
        </div>
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
                        <td><a href="{{ url('admin/editCategory/' . $category->id) }}" class="btn btn-warning editCategory"
                                id="categoryId">Edit</a> <a href="{{ url('admin/deleteCategory/' . $category->id) }}"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
