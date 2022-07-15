@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>LIST SHOW ALL COMMENT OF USERS</h3>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row">

                <div class="col-md-2">
                    <a href="{{ route('user.index') }}" type="button" class="btn btn-primary">Back Index User</a>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Content</th>
                        <th scope="col">Post_ID</th>
                        <th scope="col">User_ID</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td scope="row">{{$comment->id}}</td>
                            <td>{{$comment->content}}</td>
                            <td>{{$comment->post_id}}</td>
                            <td>{{$comment->user_id}}</td>
                            <td>
                                <a href="" type="button" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
