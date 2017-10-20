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
                    <th>Expiration date</th>
                    <th>Days till expiration</th>
                    <th>Client</th>
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
                            {{ Form::open(['route'=>'postDeliver']) }}
                            {{ csrf_field() }}
                            <input type="text" value="{{ $egg->id }}" name="egg_id" hidden required>
                            <select name="client_id" class="form-control col col-sm-12 col-md-6 col-lg-6" required>
                                <option value="" selected disabled="">Select client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="submit"
                                    class="btn btn-success text-white">Deliver
                            </button>
                            {{ Form::close() }}
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