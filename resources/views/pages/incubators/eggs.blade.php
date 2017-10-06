@extends('templates.dashboardmaster')

@section('title', 'List of incubators')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postAddIncubatorEgg']) }}
                    {{ csrf_field() }}
                    <input type = "text" value = "{{ $incubator->id }}" name = "incubator" hidden required>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class = "form-control" name = "egg">
                                @foreach($eggs as $egg)
                                    <option value = "{{ $egg->id }}">{{ strtolower($egg->slug) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <h4 class="text-muted">{{ $incubator->name }} eggs</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Expiration date</th>
                    <th>Days till expiration</th>
                </tr>
                </thead>
                <tbody>
                @foreach($incubator->eggs as $egg)
                    <tr>
                        <td>{{ ucwords($egg->name) }}</td>
                        <td>{{ strtolower($egg->slug) }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->toDateString() }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->diffForHumans() }}</td>
                        <td>
                            {{ Form::open(['route'=>'postRemoveEgg']) }}
                        {{ csrf_field() }}
                            <input type = "text" value = "{{ $egg->id }}" name = "egg" hidden required>
                            <button type = "submit" class="btn btn-danger text-white">Remove</button>
                        {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="response-display">
            @include('snippets.dialog')
        </div>
    </div>
    </div>
@endsection

@section('additionalJS')
@endsection