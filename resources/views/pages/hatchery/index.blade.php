@extends('templates.dashboardmaster')

@section('title', 'List of hatcheries')

@section('content')
    <h4 class="text-muted">List of hatcheries under {{ Auth::user()->farm->first()->name }}</h4>
    <div class="row">
        @foreach($hatcheries as $hatchery)
            <div class="col-sm-12 col-md-2 col-lg-2" style="margin: 4px;">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <span class="badge {{ $hatchery->eggs->count() ? 'bg-danger' : 'bg-success' }} badge-default">{{ $hatchery->farm->name }}</span>
                                <h1 class="text-center"><i
                                            class="fa fa-inbox {{ $hatchery->eggs->count() ? 'text-danger' : 'text-success' }}"
                                            aria-hidden="true"></i></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p class="text-muted">Name: {{ ucwords($hatchery->name) }}</p>
                                <p class="text-muted">Slug: {{ strtolower($hatchery->slug) }}</p>
                                <p class="text-muted">Number of eggs: {{ strtolower($hatchery->eggs->count()) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <a href="{{ route('getHatcheryEggs', ['id' => $hatchery->id]) }}"
                                   class="btn btn-success text-white">Eggs
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <a href="{{ route('getEditHatchery', ['id' => $hatchery->id]) }}"
                                   class="btn btn-success text-white">Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>


    {{ $hatcheries->links('vendor.pagination.bootstrap-4') }}
@endsection

@section('additionalJS')
@endsection