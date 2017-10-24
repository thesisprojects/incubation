@extends('templates.dashboardmaster')

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Content</th>
                        <th>Occurence date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>{{ ucfirst($notification->content) }}</td>
                            <td>{{ \Carbon\Carbon::parse($notification->created_at)->toDateString() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection