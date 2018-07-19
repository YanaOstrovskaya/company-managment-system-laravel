@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="container">
           <img class="img-thumbnail" src="/images/logo/{{$logo}}" alt="" style="width: 400px;">
        </div>
    </div>

    <div class="col-md-9">
        <div class="container">
            <h2>Companies</h2>
                <button type="button" class="btn btn-primary create-modal float-right" data-toggle="modal" data-target="#myModal">
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
                <tr>
                    <td class="align-middle company-logo"><img class="company-logo-img" src="/images/logo/{{$company->logo}}" alt="{{$company->name}}" width="100px"></td>
                    <td class="align-middle">{{$company->name}}</td>
                    <td class="align-middle">{{$company->country}}</td>
                    <td class="align-middle">{{$company->city}}</td>
                    @if(Auth::user()->role==='admin' || isset(Auth::user()->company->owner_id) && Auth::user()->company->owner_id==$company->owner_id)
                    <td class="align-middle"><a class="btn btn-primary" href="/company/{{$company->id}}/edit">Edit</a></td>
                    @endif
                    @if(Auth::user()->role==='admin')
                        <td class="align-middle">
                        <form method="POST" action="/company/{{$company->id}}" enctype="multipart/form-data">
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



<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create company</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               @include('company.create')
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="create" >Create</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

</div>
@endsection