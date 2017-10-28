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
                        <h4 class="card-title text-muted"><i class="fa fa-frown-o" aria-hidden="true"></i> Near expire
                        </h4>
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
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card" style="width: 30rem;">
                    <div class="card-body">
                        <canvas id="myChart" width="100%" height="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionalJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        $.get('delivery/yeardata', function (response) {
            var ctx = $("#myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: 'Sale chart',
                        data: response,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

    </script>
@endsection