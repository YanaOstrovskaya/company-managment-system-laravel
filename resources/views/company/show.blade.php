@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('images/logo/'.$company->logo)}}" alt="{{$company->name}}">
                <br><br>
                <div class="col-md-6 text-center">
                    @if(Auth::user()->role==='admin' || isset(Auth::user()->company->owner_id) && Auth::user()->company->owner_id==$company->owner_id)
                        <a href="/company/{{$company->id}}/edit" class="btn btn-primary btn-block">Edit company</a>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td>{{ $company->name}}</td>
                    </tr>
                        <tr>
                            <th>Adress 1</th>
                            <td>{{ $company->adress_line1}}</td>
                        </tr>
                    <tr>
                        <th>Adress 2</th>
                        <td>{{$company->adress_line2}}</td>
                    </tr>
                    <tr>
                        <th>Zip</th>
                        <td>{{$company->zip}}</td>
                    </tr>
                    <tr>
                        @if(!empty($company->province))
                        <th>Province</th>
                        <td>{{$company->province}}</td>
                        @endif
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{$company->city}}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{$company->country}}</td>
                    </tr>
                    <tr>
                        @if(!empty($company->owner_id))
                            <th>Owner</th>
                                <td><a class="link" href="{{asset('users/'.$user->id)}}">{{$user->name}}</a></td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>

@endsection