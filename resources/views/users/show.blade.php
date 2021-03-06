@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('images/photo/'.$user->employeeProfile->photo)}}" alt="{{$user->name}}">
                <br><br>
                <div class="col-md-6 text-center">
                    @if(Auth::user()->id === $user->id)
                    <a href="/users/{{$user->id}}/edit" class="btn btn-primary btn-block">Edit profile</a>
                        @endif
                </div>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name}}</td>
                    </tr>
                    @if($user->role==='admin')
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role}}</td>
                        </tr>
                        @endif
                    <tr>
                        <th>Email</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Birhday</th>
                        <td>{{$birhdate->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th>Job start date</th>
                        <td>{{$job_start_date->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$user->employeeProfile->phone}}</td>
                    </tr>
                    <tr>
                        <th>Job title</th>
                        <td>{{$user->employeeProfile->job_title}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
            @if(!empty($user->company))
                <br><br>
            <h2 class="text-center">Companies</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>City</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td> <img class="company-logo" src="{{ asset('images/logo/'.$company->logo) }}" width="100px"></td>
                            <td class="align-middle"><a class="link" href="{{asset('company/'.$company->id)}}">{{$company->name}}</a></td>
                            <td class="align-middle">{{$company->country}}</td>
                            <td class="align-middle">{{$company->city}}</td>
                            <td class="align-middle"><a class="btn btn-primary" href="/company/{{$company->id}}/edit">Edit</a></td>
                            <td class="align-middle">
                            @if(Auth::user()->role==='admin')
                                    <form method="POST" action="/company/{{$company->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete">Delete</button>
                                    </form>
                                @endif
                                </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif
            </div>
        </div>
    </div>
@endsection