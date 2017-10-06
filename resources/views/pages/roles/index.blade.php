@extends('templates.dashboardmaster')

@section('title', 'Roles and Permissions')

@section('content')
    <div class="card">
        <div class="card-body">
            @include('snippets.dialog')
        </div>
        {{ Form::open(['route'=>'postCreateRole']) }}
        @component('components.modal', [
            'id' => 'create-roles-modal',
            'title' => 'Create role',
            'buttons' => [
                [
                'title' => 'Create',
                'type' => 'submit',
                'class' => 'btn-success'
                ]
            ],
        ])
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="name-input">Role name</label>
                    <input type="text" id="name-input" name="name" minlength="2" maxlength="8" required>
                    <small id="nameHelp" class="form-text text-muted">Roles name.</small>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="description-input">Description</label>
                    <input type="text" id="description-input" name="description" minlength="4" maxlength="16" required>
                    <small id="descriptionHelp" class="form-text text-muted">A short description for the role.</small>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach($permissions as $permission)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <p>
                        <input type="checkbox" class="filled-in" name="role_data_{{ $permission->name }}" id="{{ $permission->name }}_box" value="{{ $permission->id }}"/>
                        <label for="{{ $permission->name }}_box">{{ ucfirst($permission->name) }}</label>
                    </p>
                </div>
            @endforeach
        </div>
        @endcomponent
        {{ Form::close() }}
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-l12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-l12">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#create-roles-modal">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-l12">
                            @component('components.table', ['tableHeaders' => ['Role', 'Permissions', '']])
                            @foreach($roles as $role)
                                <tr>
                                    <td>
                                        <b>{{ ucwords($role->name) }}</b>
                                    </td>
                                    <td>
                                        <div class="row">
                                            @foreach($role->permissions as $permission)
                                                <div class="col-sm-12 col-md-6 col-lg-4 text-grey"><label>-{{ ucfirst($permission->name) }}</label></div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="grey-text center">
                                        <div class="row">
                                            <a href="{{ Route('getEditRole', ['roleID' => $role->id]) }}" class="btn btn-success">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('additionalJS')
@endsection