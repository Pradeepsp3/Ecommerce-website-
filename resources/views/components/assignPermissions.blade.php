@extends('master')
@section('title', 'Add and view Permissions')
@section('main-content')
    @if ($message = Session::get('deleteAllRolesPermissions'))
        <div class="alert alert-danger container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('permissionAssigned'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        <form action="{{ url('admin/assignPermissions') }}">
            <label for="categoryType" class="h5">Select Role Type</label>
            <select class="form-select" aria-label="Default select example" name="roleId">
                @if ($roleId != '')
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if ($roleId == $role->id) selected @endif>
                            {{ $role->roles }}</option>
                    @endforeach
                @else
                    <option selected>Open to select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->roles }}</option>
                    @endforeach
                @endif
            </select>
            @error('roleId')
                <div class="error">{{ '*' . $message }}</div>
            @enderror
            <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-info mt-2" value="Select">
                    @if(isset($roleId))
                    <a href="{{ url('admin/deleteRolesPermission/' . $roleId) }}" class="btn btn-danger mt-2 ms-3">Clear all Permissions</a>
                    @endif
            </div>
        </form>
    </div>
    @php
        $addCategory = '';
        $viewCategory = '';
        $editCategory = '';
        $deleteCategory = '';
        $addProduct = '';
        $viewProduct = '';
        $editProduct = '';
        $deleteProduct = '';
        $addUser = '';
        $viewUser = '';
        $viewUserDetails = '';
        $editUser = '';
        $deleteUser = '';
    @endphp
    @if (isset($roleId))
        {{-- <a href="{{ url('admin/deleteRolesPermission/' . $roleId) }}" class="btn btn-danger" style="margin-left: 48%;">Clear
            all Permission for this Role</a> --}}
        @foreach ($rolesWithPermissions as $roleWithPermission)
            @php
                if ($roleWithPermission->permissions_id == 1) {
                    $addCategory = 1;
                }
                if ($roleWithPermission->permissions_id == 2) {
                    $viewCategory = 2;
                }
                if ($roleWithPermission->permissions_id == 3) {
                    $editCategory = 3;
                }
                if ($roleWithPermission->permissions_id == 4) {
                    $deleteCategory = 4;
                }
                if ($roleWithPermission->permissions_id == 5) {
                    $addProduct = 5;
                }
                if ($roleWithPermission->permissions_id == 6) {
                    $viewProduct = 6;
                }
                if ($roleWithPermission->permissions_id == 7) {
                    $editProduct = 7;
                }
                if ($roleWithPermission->permissions_id == 8) {
                    $deleteProduct = 8;
                }
                if ($roleWithPermission->permissions_id == 9) {
                    $addUser = 9;
                }
                if ($roleWithPermission->permissions_id == 10) {
                    $viewUser = 10;
                }
                if ($roleWithPermission->permissions_id == 11) {
                    $editUser = 11;
                }
                if ($roleWithPermission->permissions_id == 12) {
                    $deleteUser = 12;
                }
                if ($roleWithPermission->permissions_id == 13) {
                    $viewUserDetails = 13;
                }
            @endphp
        @endforeach
        <div class="form">
            <form action="{{ url('admin/storePermissions') }}" method="post">
                @csrf
                <input type="hidden" name="roleId" value={{ $roleId }}>
                <div>
                    <div class="d-flex mb-3">
                        <dl class="">
                            <dt class="mb-3">
                                <strong class="me-4 fs-5">Users:</strong>
                                <span class="form-check-inline">
                                    <label class="form-check-label" for="inlineCheckbox3">Check All</label>
                                    <input class="form-check-input category ms-2" type="checkbox" id="allUsers"
                                        onclick="checkAllUsers()" value="" />
                                </span>
                            </dt>
                            <div class="d-flex">
                                <dd class="col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input user" type="checkbox" name="addUser"
                                        value="9" @if ($addUser == 9) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox1">Add
                                        User</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input user" type="checkbox" name="viewUser"
                                        value="10" @if ($viewUser == 10) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox2">View
                                        User</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input user" type="checkbox" name="viewUserDetails"
                                        value="13" @if ($viewUserDetails == 13) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">View
                                        User Details</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input user" type="checkbox" name="editUser"
                                        value="11" @if ($editUser == 11) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">Edit
                                        User</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input user" type="checkbox" name="deleteUser"
                                        value="12" @if ($deleteUser == 12) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">Delete
                                        User</label>
                                </dd>

                            </div>
                    </div>
                    <div class="d-flex mb-3">
                        <dl class="">
                            <dt class="mb-3">
                                <strong class="me-4 fs-5">Category:</strong>
                                <span class="form-check-inline">
                                    <label class="form-check-label" for="inlineCheckbox3">Check All</label>
                                    <input class="form-check-input category ms-2" type="checkbox" id="allCategories"
                                        onclick="checkAllCategories()" value="" />
                                </span>
                            </dt>
                            <div class="d-flex">
                                <dd class="col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input category" type="checkbox" name="addCategory"
                                        value="1" @if ($addCategory == 1) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox1">Add
                                        Category</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input category" type="checkbox" name="viewCategory"
                                        value="2" @if ($viewCategory == 2) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox2">View
                                        Category</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input category" type="checkbox" name="editCategory"
                                        value="3" @if ($editCategory == 3) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">Edit
                                        Category</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input category" type="checkbox" name="deleteCategory"
                                        value="4" @if ($deleteCategory == 4) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">Delete
                                        Category</label>
                                </dd>
                            </div>
                    </div>
                    <div class="d-flex mb-3">
                        <dl class="">
                            <dt class="mb-3">
                                <strong class="me-4 fs-5">Product:</strong>
                                <span class="form-check-inline">
                                    <label class="form-check-label" for="inlineCheckbox3">Check All</label>
                                    <input class="form-check-input product ms-2" type="checkbox" id="allProducts"
                                        onclick="checkAllProducts()" value="" />
                                </span>
                            </dt>
                            <div class="d-flex">
                                <dd class="col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input product" type="checkbox" name="addProduct" value="5"
                                        @if ($addProduct == 5) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox1">Add
                                        product</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input product" type="checkbox" name="viewProduct"
                                        value="6" @if ($viewProduct == 6) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox2">View
                                        product</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input product" type="checkbox" name="editProduct"
                                        value="7" @if ($editProduct == 7) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">Edit
                                        product</label>
                                </dd>

                                <dd class=" col-md-3 form-check form-check-inline me-5">
                                    <input class="form-check-input product" type="checkbox" name="deleteProduct"
                                        value="8" @if ($deleteProduct == 8) checked @endif />
                                    <label class="form-check-label ms-2 text-dark" for="inlineCheckbox3">Delete
                                        product</label>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Save Permissions">
                </div>
            </form>
        </div>
    @endif
@endsection
