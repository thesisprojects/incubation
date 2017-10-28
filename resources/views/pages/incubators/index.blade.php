@extends('templates.dashboardmaster')

@section('title', 'List of incubators')

@section('content')
    <div class="row">
        @foreach($incubators as $incubator)
            <div class="col-sm-12 col-md-2 col-lg-2" style="margin: 4px;">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <span class="badge {{ $incubator->eggs->count() ? 'bg-danger' : 'bg-success' }} badge-default">{{ $incubator->farm->name }}</span>
                                <h1 class="text-center"><i
                                            class="fa fa-inbox {{ $incubator->eggs->count() ? 'text-danger' : 'text-success' }}"
                                            aria-hidden="true"></i></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p class="text-muted">Name: {{ ucwords($incubator->name) }}</p>
                                <p class="text-muted">Slug: {{ strtolower($incubator->slug) }}</p>
                                <p class="text-muted">Number of eggs: {{ strtolower($incubator->eggs->count()) }}</p>
                                <p class="text-muted">Number of eggs: {{ strtolower($incubator->eggs->count()) }}</p>
                                <p class="text-muted">{{ $incubator->eggs->where('is_expired', 1)->count() }} / {{ $incubator->eggs->count() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <a href="{{ route('getAssignEggs', ['id' => $incubator->id]) }}"
                                   class="btn btn-success text-white">Eggs
                                </a>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <a href="{{ route('getEditIncubator', ['id' => $incubator->id]) }}"
                                   class="btn btn-success text-white">Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>


    {{ $incubators->links('vendor.pagination.bootstrap-4') }}
@endsection

@section('additionalJS')
@endsection