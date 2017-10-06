@extends('templates.dashboardmaster')

@section('title', 'List of farms')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-muted">List of farms</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Address</th>
                  
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($farms as $farm)
                    <tr>
                        <td>{{ ucwords($farm->name) }}</td>
                        <td>{{ ucfirst($farm->description) }}</td>
                        <td>{{ ucfirst($farm->address) }}</td>
                        
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditFarm', ['id' => $farm->id]) }}')" class="btn btn-success text-white">Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $farms->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection