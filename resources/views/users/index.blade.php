@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="container">

            </div>
        </div>

        <div class="col-md-10">
            <div class="container">
                <h2>Users</h2>

                <br><br>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Job title</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr id="addCompany">
                            <td class="align-middle company-logo"><img class="company-logo-img" src="/images/photo/{{$user->employeeProfile->photo}}" alt="{{$user->name}}" width="100px"></td>
                            <td class="align-middle"><a class="link" href="{{asset('users/'.$user->id)}}">{{$user->name}}</a></td>
                            <td class="align-middle">{{$user->email}}</td>
                            <td class="align-middle">{{$user->employeeProfile->job_title}}</td>
                            @if(Auth::user()->role==='admin' || Auth::user()->id == $user->id)
                                <td class="align-middle"><a class="btn btn-primary" href="/users/{{$user->id}}/edit">Edit</a></td>
                            @endif
                            @if(Auth::user()->role==='admin')
                                <td class="align-middle">
                                    <form method="POST" action="/users/{{$user->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection