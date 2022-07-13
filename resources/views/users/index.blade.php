@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>LIST ALL USERS </h3>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row">

                <div class="col-md-2">
                    <a href="{{ route('user.create') }}" type="button" class="btn btn-primary">Create User</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('home') }}" type="button" class="btn btn-success">Back Home</a>
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
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Create_At</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>
                                <a href="{{ url('/posts/'.$user->id.'/shows') }}" type="" class="">{{$user->name}}</a>

                            </td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->format('d-m-Y')}}</td>
                            <td>{{!empty($user->profile) ? $user->profile->province : ''}}</td>
                            <td>
                                <a href="{{ url('/users/'.$user->id.'/comments') }}" type="button" class="btn btn-info">Show C</a>
                                <a href="{{ url('/users/'.$user->id ) }}" type="button" class="btn btn-warning">Detail U</a>
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
