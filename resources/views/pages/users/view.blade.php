@extends('templates.dashboardmaster')

@section('title', 'List of users')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-muted">List of users</h4>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Farm</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ ucwords(!is_null($user->farm) ? $user->farm->name : 'NO FARM') }}</td>
                        <td>{{ ucwords($user->first_name) }}</td>
                        <td>{{ ucwords($user->last_name) }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ ucfirst($user->email) }}</td>
                        <td>{{ ucwords($user->roles->count() > 0 ? $user->roles->first()->name : 'NO ROLE') }}</td>
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditUser', ['id' => $user->id]) }}')" class="btn btn-success text-white">Edit</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection