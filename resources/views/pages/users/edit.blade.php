@extends('templates.dashboardmaster')

@section('title', 'Edit User')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="center text-muted">Edit User</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postEditUser']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <select name = "farm_id" class="custom-select form-control" required>
                                    @if(!is_null($user->farm))
                                        <option value="{{ $user->farm->id }}">
                                            {{ ucwords($user->farm->name) }}
                                        </option>
                                    @endif
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
                                <input type="text" class="form-control" value="{{ ucwords($user->first_name) }}" id="firstname-input" name="first_name" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="lastname-input">Last name</label>
                                <input type="text" class="form-control" value="{{ ucwords($user->last_name) }}" id="lastname-input" name="last_name" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="username-input">Username</label>
                                <input type="text" class="form-control" id="username-input" value="{{ $user->username }}" name="username" minlength="2" maxlength="10" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="email-input">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" id="email-input" name="email" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="password-input">Password</label>
                                <input type="password" class="form-control" id="password-input" name="password">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="role-input">Role</label>
                                <select name="role" id="role-input" class="custom-select form-control">
                                    @if($user->roles->count() > 0)
                                        <option value="{{ $user->roles->first()->id }}" selected>{{ $user->roles->first()->name }}</option>
                                    @endif
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