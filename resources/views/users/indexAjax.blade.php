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
            <div id="notication">

            </div>
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
                        <th scope="col">Create_At</th>
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
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa người dùng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notication">
                    </div>
                    <form action="{{ route('user.store') }}" class="" method="POST">
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
                            <div class="col-md-12 mt-2">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('user.index') }}" type="button" class="btn btn-secondary">Back</a>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Create New User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="button" name="button" class="btn btn-primary" id="button-create"
                        title="Tạo mới người dùng">Tạo mới người dùng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/users_ajax.js') }}"></script>
@endsection
