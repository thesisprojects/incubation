@extends('templates.dashboardmaster')

@section('title', 'List of eggs')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-muted">List of eggs under {{ Auth::user()->farm->name }}</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Farm</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Expiration date</th>
                    <th>Days till expiration</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($eggs as $egg)
                    <tr>
                        <td>{{ ucfirst($egg->farm->name) }}</td>
                        <td>{{ ucfirst($egg->name) }}</td>
                        <td>{{ strtolower($egg->slug) }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->toDateString() }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->diffForHumans() }}</td>
                        
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditEgg', ['id' => $egg->id]) }}')" class="btn btn-success text-white">Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $eggs->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection