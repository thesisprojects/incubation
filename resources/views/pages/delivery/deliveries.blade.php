@extends('templates.dashboardmaster')

@section('title', 'List of eggs')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Delivered at</th>
                    <th>Delivery date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deliveries as $delivery)
                    <tr>
                        <td>{{ ucfirst($delivery->client->name) }}</td>
                        <td>{{ ucfirst($delivery->type) }}</td>
                        <td>{{ $delivery->type == "egg" ? $delivery->egg->name : $delivery->chick->name }}</td>
                        <td>{{ $delivery->type == "egg" ? $delivery->egg->slug : $delivery->chick->slug }}</td>
                        <td>{{ \Carbon\Carbon::parse($delivery->created_at)->diffForHumans() }}</td>
                        <td>{{ $delivery->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $deliveries->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection