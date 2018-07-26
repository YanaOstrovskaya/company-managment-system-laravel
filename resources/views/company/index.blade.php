@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-2">

    </div>

    <div class="col-md-10">
        <div class="container">
            <h2>Companies</h2>
                <button type="button" class="btn btn-primary create-modal float-right" data-toggle="modal" data-target="#myModalCreate">
                    New company
                </button>

            <br><br>
            <table class="table">
                <thead class="thead-light">
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
                <tr id="addCompany">
                    <td class="align-middle company-logo"><img class="company-logo-img" src="/images/logo/{{$company->logo}}" alt="{{$company->name}}" width="100px"></td>
                    <td class="align-middle"><a class="link" href="{{asset('company/'.$company->id)}}">{{$company->name}}</a></td>
                    <td class="align-middle">{{$company->country}}</td>
                    <td class="align-middle">{{$company->city}}</td>
                    @if(Auth::user()->role==='admin' || isset(Auth::user()->company->owner_id) && Auth::user()->company->owner_id==$company->owner_id)
                    <td class="align-middle"><a class="btn btn-primary" href="/company/{{$company->id}}/edit">Edit</a></td>
                    @endif
                    @if(Auth::user()->role==='admin')
                        <td class="align-middle">
                        <form method="POST" action="/company/{{$company->id}}">
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
            {{ $companies->links() }}
    </div>
    </div>
</div>

    @endsection

<!-- The Modal -->
@section('modal')
    @include('company.create')
@endsection




