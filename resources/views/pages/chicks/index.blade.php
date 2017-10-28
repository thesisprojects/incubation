@extends('templates.dashboardmaster')

@section('title', 'List of chicks')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Egg</th>
                </tr>
                </thead>
                <tbody>
                @foreach($chicks as $chick)
                    <tr>
                        <td>{{ ucwords($chick->name) }}</td>
                        <td>{{ strtolower($chick->slug) }}</td>
                        <td>{{ strtolower($chick->egg->name) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h1>TOTAL: {{ $chicks->count() }}</h1>
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