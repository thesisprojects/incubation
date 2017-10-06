@extends('templates.dashboardmaster')

@section('title', 'Roles and Permissions')

@section('content')
    <div class="card" id="editroleapp">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card-body">
                        <label id="route" hidden>{{ Route('postUpdateRole') }}</label>
                        <a class="right hover-red" href="{{ route('getRoles') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go back</a>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="grey-text">Editing {{ lcfirst($role->name) }}'s permissions.</label>
                            </div>
                            <input type="text" name="role" value="{{ $role->id }}" id="role" hidden>
                        </div>

                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <p>
                                        <input type="checkbox" class="filled-in" name="role_data_{{ $permission->name }}" id="{{ $permission->name }}_box"
                                               value="{{ $permission->id }}" {{$role->permissions->contains('name', $permission->name) ? 'checked' : ''}} @change = "
                                        togglePermission('{{$permission->id}}')
                                    "/>
                                        <label title="{{ $permission->description }}" for="{{ $permission->name }}_box">{{ ucfirst($permission->name) }}</label>
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <div class="row" id="save-loader" style = "display:none;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p class = "text-muted">Processing...</p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 100%"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="response-display">

        </div>
    </div>
@endsection

@section('additionalJS')
    <script src="{{ URL::asset('js/editrole.js') }}"></script>
@endsection