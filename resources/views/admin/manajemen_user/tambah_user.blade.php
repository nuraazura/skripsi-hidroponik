@extends('layouts.base')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
          {{-- <button type="button" class="btn btn-primary btn-sm">
            <a href="{{route ('admin.manajemen_user.tambah_user')}}" style="color: white">
            <i class="fas fa-user-plus"></i> Tambah User</a>
          </button> --}}
        </div>
        <form method="post" action="{{route ('admin.manajemen_user.store')}} " class="form-horizontal">
            @csrf
            <div class="card-body">
              @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
                <div class="form-group row">
                  <label for="inputname" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputname" name="name" placeholder="nama" required>
                  </div>
                </div>
        
                <div class="form-group row">
                  <label for="inputemail" class="col-sm-2 col-form-label">email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="email" required>
                  </div>
                </div>
        
                <div class="form-group row">
                  <label for="inputpassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputpassword" name="password" placeholder="password" required>
                  </div>
                </div>
        
                <div class="form-group row">
                  <label for="inputadress" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                  <textarea type="text" class="form-control" id="inputadress" name="alamat" rows="3" placeholder="alamat lengkap" required></textarea>
                    {{--  <input type="text" class="form-control" name="name" value="" >  --}}
                  </div>
                </div>
        
                <div class="form-group row">
                  <label for="inputno_hp" class="col-sm-2 col-form-label">No Hp</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputno_hp" name="no_hp"  placeholder="nomor hp" required></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputlevel" class="col-sm-2 col-form-label">Level</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="level" id="inputlevel">
                      <option>petani</option>
                    </select>
                    {{-- <input type="text" class="form-control" id="inputlevel" name="level" placeholder="level" required> --}}
                  </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{route ('admin.manajemen_user.index')}}" style="color: white"><button type="button" class="btn btn-secondary">Batal</a></button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection