@extends('templates.dashboardmaster')

@section('title', 'List of incubators')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class = "grey-text">{{ $incubator->farm->name }} farm</h3>
                    {{ Form::open(['route'=>'postAddIncubatorEgg']) }}
                    {{ csrf_field() }}
                    <input type="text" value="{{ $incubator->id }}" name="incubator" hidden required>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="egg" required>
                                <option value="" selected disabled="">Select egg</option>
                                @foreach($eggs as $egg)
                                    <option value="{{ $egg->id }}">{{ strtolower($egg->slug) }}</option>
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
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ Form::open(['route'=>'postBulkHatceryTransfer']) }}
                    {{ csrf_field() }}
                    <select name="hatchery_id" class="form-control" required>
                        <option value="" selected disabled="">Select hatchery</option>
                        @foreach($hatcheries as $hatchery)
                            <option value="{{ $hatchery->id }}">{{ $hatchery->name }}
                                ({{ $hatchery->slug }}
                                )
                            </option>
                        @endforeach
                    </select>
                    <input type="text" value="{{ $incubator->id }}" name="incubator" hidden required>
                    <br>
                    <button class="btn btn-success" type="submit">Bulk transfer to hatchery</button>
                    <br> <br>

                    {{ Form::close() }}
                </div>
            </div>
            <h4 class="text-muted">{{ $incubator->name }} eggs</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Transfer to hatchery</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($incubator->eggs as $egg)
                    <tr>
                        <td>{{ ucwords($egg->name) }}</td>
                        <td>{{ strtolower($egg->slug) }}</td>
                        <td>
                            {{ Form::open(['route'=>'postTransferEgg']) }}
                            {{ csrf_field() }}

                            <input type="text" value="{{ $egg->id }}" name="egg" hidden required>
                            <select name="hatchery_id" class="form-control col col-sm-12 col-md-6 col-lg-6" required>
                                <option value="" selected disabled="">Select hatchery</option>
                                @foreach($hatcheries as $hatchery)
                                    <option value="{{ $hatchery->id }}">{{ $hatchery->name }}
                                        ({{ $hatchery->slug }}
                                        )
                                    </option>
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <button type="submit"
                                    class="btn btn-success text-white"  {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($egg->created_at)) > 17 ? "" : "disabled" }}>Transfer
                            </button>
                            {{ Form::close() }}
                        </td>
                        <td>
                            {{ Form::open(['route'=>'postRemoveEgg']) }}
                            {{ csrf_field() }}
                            <input type="text" value="{{ $egg->id }}" name="egg" hidden required>
                            <button type="submit" class="btn btn-danger text-white">Remove</button>
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