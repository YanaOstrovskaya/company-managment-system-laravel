@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1>Edit profile</h1>
                <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="birhdate">Birhdate:</label>
                        <input type="date" class="form-control" id="birhdate" name="birhdate" value="{{$user->employeeProfile->birhdate}}">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <img class="img-thumbnail" src="{{ asset('images/photo/'.$user->employeeProfile->photo) }}" alt="{{$user->name}}" width="100px;">
                    </div>
                    <div class="form-group">
                        <label for="adress_line2">Replace photo:</label>
                        <input type="file" class="form-control" id="photo" name="photo" >
                    </div>
                    <div class="form-group">
                        <label for="zip">Job start date:</label>
                        <input type="date" class="form-control" id="job_start_date" name="job_start_date" value="{{$user->employeeProfile->job_start_date}}">
                    </div>
                    <div class="form-group">
                        <label for="province">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->employeeProfile->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="job_title">Job title:</label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="{{$user->employeeProfile->job_title}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection