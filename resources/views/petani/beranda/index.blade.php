@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row mb-3">
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Status Led Growlight</div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @foreach ($statusGrowLight as $item)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$item['kode_alat']}} / {{ $item['status'] == 1 ? 'ON' : 'OFF' }}</div>
                            @endforeach
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Jumlah Growlight</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lightbulb fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Node</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlahAlat}}</div>
                            {{-- <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> Bacot</span>
                                <span>abim adek zura</span>
                            </div> --}}
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <span>Jumlah Node Keseluruhan</span>
                        </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-podcast fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Suhu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format((float)$suhuUdaraRata, 2, ',', '')}}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai rata-rata perhari</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thermometer-full fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Kelembapan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format((float)$kelembapanAirRata, 2, ',', '')}}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai rata-rata perhari</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-snowflake fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Nutrisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format((float)$nutrisiAirRata, 2, ',', '')}}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Nilai rata-rata perhari</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-industry fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection