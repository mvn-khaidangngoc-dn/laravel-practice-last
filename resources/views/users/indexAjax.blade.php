@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>LIST ALL USERS AJAX </h3>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row">
                <div class="col-md-2">
                    <button class="btn btn-primary" id="createUser">Add User</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('home') }}" type="button" class="btn btn-success">Back Home</a>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="search" id="search-bar" class="form-control rounded" placeholder="Input Value" aria-label="Search"
                        aria-describedby="search-addon" />
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <select name="type" id="type-search" class="form-control">
                                    <option selected disabled>Search Option</option>
                                    <option value="0">Search Name</option>
                                    <option value="1">Search Number of Posts</option>
                                    <option value="2">Search Number of Comments</option>
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-danger"><i
                                            class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 detail-course-finish">
            @if (session('success'))
                <div class="bg-success">
                    <p class="text-light">{{ session('success') }}</p>
                </div>
            @elseif(session('fails'))
                <div class="bg-danger">
                    <p class="text-light">{{ session('fails') }}</p>
                </div>
            @endif
        </div>
        <div class="col-md-12 mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="sort_ID" data-sort="DESC" data-toggle="tooltip" data-placement="top">ID
                            <span style="margin-left: 5px"><i class="fas fa-sort"></i></span>
                            <input type="hidden" class="sort_type_id" value="">
                        </th>
                        <th scope="col" class="sort_name" data-sort="DESC" data-toggle="tooltip" data-placement="top">Name
                            <span style="margin-left: 5px"><i class="fas fa-sort"></i></span>
                            <input type="hidden" class="sort_type" value="">
                        </th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Sum Post</th>
                        <th scope="col">Sum Comment</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal create user --}}
    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="notication">
                    </div>
                    <form id="form-user" action="" class="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="DNK">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" >
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" name="birthday" id="birthday">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option selected disabled>Select Status</option>
                                    <option value="0">Active</option>
                                    <option value="1">No Active</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" name="avatar" id="avatar">
                            </div>
                            <div class="hidden">
                                <input hidden type="text" id="action" name="action" value="create">
                                <input hidden type="text" id="id-user" name="id" value="">
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                        <button type="button" name="button" class="btn btn-primary" id="button-create"
                            title="Add New User">Add New User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal update user --}}
    <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eidt User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="notication-update">
                    </div>
                    <form id="form-user-update" action="{{ route('user.updateUser') }}" class="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3 hidden">
                                <input hidden type="text" class="form-control" name="id_update" id="id_update">
                            </div>
                            <div class="mb-3">
                                <label for="name_update" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name_update" id="name_update" placeholder="DNK">
                            </div>
                            <div class="mb-3">
                                <label for="email_update" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email_update" id="email_update" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="birthday_update" class="form-label">Birthday</label>
                                <input type="date" class="form-control" name="birthday_update" id="birthday_update">
                            </div>
                            <div class="mb-3">
                                <label for="status_update" class="form-label">Status</label>
                                <select class="form-select" name="status_update" id="status_update" aria-label="Default select example">

                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" name="avatar_update" id="avatar_update" for="inputGroupFile01">Choose file</label>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="button" class="btn btn-primary" id="button-update"
                        title="Update User">Update User</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal delete --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="notication-delete">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="button" class="btn btn-primary" id="button-delete">Accept</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="button-finish">Finish
                        </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/users_ajax.js') }}"></script>
@endsection
