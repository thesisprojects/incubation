@extends('templates.dashboardmaster')

@section('title', 'List of eggs')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Client</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($chicks as $chick)
                    <tr>
                        <td>{{ ucfirst($chick->name) }}</td>
                        <td>{{ ucfirst($chick->slug) }}</td>
                        <td>
                            {{ Form::open(['route'=>'postDeliver']) }}
                            {{ csrf_field() }}
                            <input type="text" value="{{ $chick->id }}" name="chick_id" hidden required>
                            <input type="text" value="chick" name="type" hidden required>
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

            {{ $chicks->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection