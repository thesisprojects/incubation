@extends('templates.dashboardmaster')

@section('title', 'Create Incubator')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="center text-muted">Create Incubator</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postCreateIncubator']) }}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="name-input">Farm</label>
                                <select name = "farm_id" class="custom-select form-control" required>
                                    @foreach($farms as $farm)
                                        <option value="{{ $farm->id }}">
                                            {{ ucwords($farm->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name-input">Name</label>
                                <input type="text" class="form-control" id="name-input" name="name" minlength="2"
                                       maxlength="45" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="description-input">Slug</label>
                                <input type="text" class="form-control" id="slug-input"
                                       value="incubator-{{ \Carbon\Carbon::now()->timestamp }}"
                                       name="slug" minlength="2" maxlength="45" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Create</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
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