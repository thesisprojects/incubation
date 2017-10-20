@extends('templates.dashboardmaster')

@section('title', 'Create Egg')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="center text-muted">Create Egg</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postCreateEgg']) }}
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
                                <input type="text" class="form-control" id="name-input" name="name" minlength="2" maxlength="45" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="description-input">Slug</label>
                                <input type="text" class="form-control" value="egg-{{ \Carbon\Carbon::now()->timestamp }}" id="slug-input" name="slug" minlength="2" maxlength="45" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="address-input">Expires at</label>
                                <input type="date" class="form-control" id="expire_at-input" name="expire_at" value = "{{ Carbon\Carbon::parse(\Carbon\Carbon::now()->addDays(23))->toDateString() }}" required>
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