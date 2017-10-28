@extends('templates.dashboardmaster')

@section('title', 'List of hatchery eggs')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-muted">{{ $hatchery->name }} eggs</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Expiration date</th>
                    <th>Days till expiration</th>
                    <th>Date transfered to hatchery</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($hatchery->eggs as $egg)
                    <tr>
                        <td>{{ ucwords($egg->name) }}</td>
                        <td>{{ strtolower($egg->slug) }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->toDateString() }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->diffForHumans() }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->hatchery_date)->toDateString() }}</td>
                        <td><a href="{{ route('getHatcheryEggs', ['id' => $hatchery->id]) }}"
                               class="btn btn-success text-white">Hatch
                            </a></td>
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