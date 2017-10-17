@extends('templates.dashboardmaster')

@section('title', 'List of eggs')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-muted">List of clients</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ ucfirst($client->name) }}</td>
                        <td>{{ strtolower($client->address) }}</td>
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditClient', ['id' => $client->id]) }}')" class="btn btn-success text-white">Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $clients->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection