@extends('layouts.base')

@section('title', 'Daftar Alat')

@section('content')
 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Monitoring Alat Azura</h1>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Alat</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Kode Alat</th>
                  {{-- <th>Status</th> --}}
                  <th>Data Log Monitoring</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($alats as $alat)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$alat->kode_alat}}</td>
                  {{-- <td><span class="badge badge-warning">Aktif</span></td> --}}
                  <td><a href="{{route ('admin.monitoring.log_monitoring',$alat->kode_alat)}}">Lihat</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
