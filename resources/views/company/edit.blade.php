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
                <h1>Edit company</h1>
                <form method="POST" action="/company/{{$company->id}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
                    </div>
                    <div class="form-group">
                        <label for="adress_line1">Adress 1:</label>
                        <input type="text" class="form-control" id="adress_line1" name="adress_line1" value="{{$company->adress_line1}}">
                    </div>
                    <div class="form-group">
                        <label for="adress_line2">Adress 2:</label>
                        <input type="text" class="form-control" id="adress_line2" name="adress_line2" value="{{$company->adress_line2}}">
                    </div>
                    <div class="form-group">
                        <label for="adress_line2">Logo:</label>
                        <input type="file" class="form-control" id="logo" name="logo" >
                    </div>
                    <div class="form-group">
                        <label for="zip">Zip:</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="{{$company->zip}}">
                    </div>
                    <div class="form-group">
                        <label for="province">Province:</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{$company->province}}">
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$company->city}}">
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{$company->country}}">
                    </div>
                    <div class="form-group">
                        <label for="country">Owner company:</label>
                        <select name="owner_id" id="owner_id" class="form-control">
                            <option value="">Not selected</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}" {{ $user->id == $company->owner_id?'selected="selected"':'' }}>{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection