@extends('templates.master')

@section('title', 'Login')

@section('content')
    <div id="loginapp">
        <div class="container">
            <div class="row">
                <div class="col sm12 md12 lg12">
                    <br><br>
                    <center>
                        <div class="card text-left" style="width: 40rem;">
                            {{ Form::open(['route' => 'postLogin']) }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card-body">
                                        <h1 class="font-weight-normal">Vianney Bacus Farm </h1>
                                        @include('snippets.validationerrors')
                                        @include('snippets.autherror')
                                        @include('snippets.exceptionerror')
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="email-input" aria-describedby="Email" placeholder="Enter email">
                                            <small id="emailHelp" class="form-text text-muted">Email provided by org.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" id="password-input" aria-describedby="Password" placeholder="Enter password">
                                            <small id="passwordHelp" class="form-text text-muted">Password provided by org.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@section('additionalJS')
@endsection