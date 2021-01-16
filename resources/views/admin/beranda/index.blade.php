@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2">Jumlah User Keseluruhan</span>
                                {{-- <span>Jumlah User Keseluruhan</span> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Node</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$alat}}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"> Jumlah Node Keseluruhan</span>
                                {{-- <span>Since last month</span> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-podcast fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <canvas id="myChart" width="500" height="150"></canvas>
        </div>
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Status Led Growlight</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Aktif</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span>Since last years</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lightbulb fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Suhu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">30 C</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span>Since last years</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thermometer-full fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Kelembapan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">70 %</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span>Since last years</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-snowflake fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Nutrisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">200 ppm</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span>Since last years</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-industry fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@push('script')
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($jam) !!},
            datasets: [{
                label: 'Suhu Udara',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: {!! json_encode($data['suhu_udara']) !!},
                fill: false,
            }, {
                label: 'Nutrisi Air',
                fill: false,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                data: {!! json_encode($data['nutrisi_air']) !!},
            }, {
                label: 'Kelembapan Air',
                fill: false,
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                data: {!! json_encode($data['kelembapan_air']) !!},
            }],
            borderWidth: 1
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
							display: true,
							labelString: 'Nilai'
						}
                }],
                xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Rata-rata nilai perjam'
						}
					}],
            }
        }
    });
    </script>
@endpush
