@extends('layouts.base')

@section('title', 'Manajemen User')

@section('content')
 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Manajemen User</h6>
            <button type="button" class="btn btn-primary btn-sm">
              <a href="{{route ('admin.manajemen_user.tambah_user')}}" style="color: white">
              <i class="fas fa-user-plus"></i> Tambah User</a> </button>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Level</th>
                  <th>Daftar Alat</th>
                  {{-- <th>Status</th> --}}
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($user as $us)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$us->name}}</td>
                  <td>{{$us->level}}</td>
                  @if ($us->level != 'admin')
                  <td><a href="{{ route('admin.manajemen_alat.index', ['user_id'=>$us->id]) }}">Lihat</a></td>
                  @else
                  <td>-</td>                      
                  @endif
                  {{-- <td><span class="badge badge-warning">Aktif</span></td> --}}
                  <td>
                    <form action="{{route ('admin.manajemen_user.destroy', $us->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?')">
                        <i class="fas fa-trash"></i></button>
                      
                      <a href="{{route ('admin.manajemen_user.edit', $us->id)}}" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                    </form>
                      
                  </td>
                </tr>
                @empty
                <tr class="text-center">
                  <td colspan="5">Data Belum Tersedia</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
