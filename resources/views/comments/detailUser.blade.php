@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <span class="text-danger"><h3>DETAIL USERS - {{$userDetail->name}} </h3></span>
        </div>

        <div class="col-md-12 mt-3">
            <form action="" class="" method="">
                <div class="row">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="DNK" value="{{$userDetail->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{$userDetail->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" name="birthday" id="birthday" value="{{$userDetail->birthday}}">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" aria-label="Default select example">

                            @if ($userDetail->status == 1)
                                <option  value="{{$userDetail->status}}" selected disabled>No Active</option>
                                <option value="0">Active</option>
                            @else
                                <option  value="1" >No Active</option>
                                <option value="{{$userDetail->status}}" selected disabled>Active</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control" name="avatar" id="avatar" value="{{$userDetail->avatar}}" >
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{!empty($userDetail->profile) ? $userDetail->profile->address : 'Chưa có thông tin'}}" >
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Tel</label>
                        <input type="text" class="form-control" name="tel" id="tel" value="{{!empty($userDetail->profile) ? $userDetail->profile->tel : 'Chưa có thông tin'}}" >
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" name="province" id="province" value="{{!empty($userDetail->profile) ? $userDetail->profile->province : 'Chưa có thông tin'}}" >
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row">

                <div class="col-md-2">
                    <a href="{{ route('user.index') }}" type="button" class="btn btn-secondary">Back Index User</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
