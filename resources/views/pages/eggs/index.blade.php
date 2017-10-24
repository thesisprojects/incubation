@extends('templates.dashboardmaster')

@section('title', 'List of eggs')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Farm</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Expired</th>
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
                        <td>
                            @if($egg->is_expired)
                                <b class = "red-text">YES</b>
                            @else
                                <b class = "green-text">NO</b>
                            @endif
                        </td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->toDateString() }}</td>
                        <td>{{ Carbon\Carbon::parse($egg->expire_at)->diffForHumans() }}</td>

                        <td>
                            <button onclick="window.location.assign('{{ route('getEditEgg', ['id' => $egg->id]) }}')"
                                    class="btn btn-success text-white">Edit
                            </button>
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