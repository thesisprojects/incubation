@extends('templates.dashboardmaster')

@section('title', 'Receipt')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <center><h1 class = "text-muted">Vianney Bacus Farm </h1></center>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h4>Receipt for {{ $delivery->client->name }} dated {{ $delivery->created_at }}</h4>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h4>Item
                        name: {{ $delivery->type == "chick" ? $delivery->chick->name : $delivery->egg->name }}</h4>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h4>Item type: {{ ucwords($delivery->type) }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection