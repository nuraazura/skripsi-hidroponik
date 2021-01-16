@extends('layouts.base')

@section('title', 'Manajemen Alat')

@section('content')
 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Manajemen Alat</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Manajemen Alat</h6>
            <button type="button" class="btn btn-primary btn-sm" id="tombolTambah">
              {{-- <a href="{{route ('admin.manajemen_alat.create', $user_id)}}" style="color: white"> --}}
              <i class="fas fa-user-plus"></i> Tambah Alat</a> </button>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Kode Alat</th>
                  {{-- <th>Status</th> --}}
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($alats as $alat)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td><a href="#">{{$alat->kode_alat}}</a></td>
                  {{-- <td><span class="badge badge-warning">Aktif</span></td> --}}
                  <td>
                    <form action="{{route ('admin.manajemen_alat.destroy', $alat->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin?')">
                        <i class="fas fa-trash"></i></button>
                      
                      {{-- <a href="{{route ('admin.manajemen_alat.edit', ['alat_id'=>$alat->id, 'user_id'=>$user_id])}}" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> --}}
                    </form>
                      
                  </td>
                </tr>
                @empty
                  <tr class="text-center">
                    <td colspan="3">Data Tidak Tersedia</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Alat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="isiModalTambah"></p>
                  <form action="{{ route('admin.manajemen_alat.store', ['user_id'=>$user_id]) }}" method="post">
                    @csrf
                      <label for="">Tambah Alat Dengan Kode</label>
                      <input class="form-control" type="text" id="kode_alat" name="kode_alat">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
    <script>
        $('#tombolTambah').on('click', ()=>{
            $('#modalTambah').modal('show')

            $.get('{{route("get_kode_alat")}}', (result)=>{
                // console.log(result)
                $('input[name="kode_alat"]').val(result)
            })
        })
    </script>
@endpush