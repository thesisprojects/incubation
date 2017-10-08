@extends('templates.dashboardmaster')

@section('title', 'Create User')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="center text-muted">Create User</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postCreateUser']) }}
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
                                <label for="name-input">First name</label>
                                <input type="text" class="form-control" id="firstname-input" name="first_name" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="lastname-input">Last name</label>
                                <input type="text" class="form-control" id="lastname-input" name="last_name" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="username-input">Username</label>
                                <input type="text" class="form-control" id="username-input" name="username" minlength="2" maxlength="10" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="email-input">Email</label>
                                <input type="email" class="form-control" id="email-input" name="email" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="password-input">Password</label>
                                <input type="password" class="form-control" id="password-input" name="password" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="role-input">Role</label>
                                <select name="role" id="role-input" class="custom-select form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ ucwords($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
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