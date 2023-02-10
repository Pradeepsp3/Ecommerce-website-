@extends('master')
@section('title', 'View Users')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Users List</h3>
        <br>
    </div>
    @if ($message = Session::get('userDeleted'))
        <div class="alert alert-danger container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-10 container">
        <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewUsers') }}" method="GET">
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="role">
                        <option value="" selected>All</option>
                        <option value="0">Customer</option>
                        <option value="1">Admin</option>
                    </select>
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </form>
        </div>
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>User Name</th>
                <th>User Role</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <th>{{ $user->name }}</th>
                        <th>{{ $user->role }}</th>
                        <th>{{ $user->email }}</th>
                        <th>{{ $user->phone }}</th>
                        <th><a href="{{ url('admin/viewUserDetails/' . $user->id) }}" class="btn btn-info">View</a> <button
                                onclick="deleteUserWarning({{ $user->id }})" class="btn btn-danger">Delete</button></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade deleteUser" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Delete User Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                Do you Want to <span class="text-danger">Delete</span> the User <span class="text-danger">?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a id="deleteUserConfirm" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function deleteUserWarning(userId){

        $('.deleteUser').modal('show');
        var url = document.getElementById('deleteUserConfirm').setAttribute('href',`{{ url('admin/deleteUser/${userId}') }}`);
        // console.log(url);
    }
</script>
