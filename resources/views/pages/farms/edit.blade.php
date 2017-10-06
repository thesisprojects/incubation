@extends('templates.dashboardmaster')

@section('title', 'Edit Farm')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="center text-muted">Edit Farm</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postEditFarm']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $farm->id }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name-input">Name</label>
                                <input type="text" class="form-control" value="{{ ucwords($farm->name) }}" id="name-input" name="name" minlength="2" maxlength="45" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="description-input">Description</label>
                                <input type="text" class="form-control" value="{{ ucfirst($farm->description) }}" id="desciption-input" name="description" minlength="2" maxlength="45" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="address-input">Address</label>
                                <input type="text" class="form-control" id="address-input" value="{{ ucfirst($farm->address) }}" name="address" minlength="2" maxlength="45" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="response-display">
            @include('snippets.dialog')
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection