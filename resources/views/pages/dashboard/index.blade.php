@extends('templates.dashboardmaster')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h4 class="card-title text-muted"><i class="fa fa-truck" aria-hidden="true"></i> Delivery</h4>
                        <hr/>
                        <h6 class="card-subtitle mb-2 text-muted">Overall delivered eggs</h6>
                        <p class="card-text">{{ $overallDelivery }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Delivered this month</h6>
                        <p class="card-text">{{ $monthDelivery }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Delivered today</h6>
                        <p class="card-text">{{ $todayDelivery }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h4 class="card-title text-muted"><i class="fa fa-frown-o" aria-hidden="true"></i> Rejects</h4>
                        <hr/>
                        <h6 class="card-subtitle mb-2 text-muted">Overall rejects</h6>
                        <p class="card-text">{{ $rejectedEggs }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h4 class="card-title text-muted"><i class="fa fa-frown-o" aria-hidden="true"></i> Near expire</h4>
                        <hr/>
                        <h6 class="card-subtitle mb-2 text-muted">This month</h6>
                        <p class="card-text">{{ $thisMonthsExpiree }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">This week</h6>
                        <p class="card-text">{{ $thisWeeksExpiree }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Today</h6>
                        <p class="card-text">{{ $todaysExpiree }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection