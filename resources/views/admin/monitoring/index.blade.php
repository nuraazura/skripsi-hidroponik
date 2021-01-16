@extends('layouts.base')

@section('title', 'Monitoring')

@section('content')
 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Monitoring</h1>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Petani</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Nama Petani</th>
                  {{-- <th>Status</th> --}}
                  <th>Daftar Alat</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($level as $lvl)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$lvl->name}}</a></td>
                    {{-- <td><span class="badge badge-success">Aktif</span></td> --}}
                    <td><a href="{{route ('admin.monitoring.daftar_alat', ['user_id'=>$lvl->id])}}" class="btn btn-sm btn-primary">Lihat</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->
  </div>
  <!---Container Fluid-->
  @endsection