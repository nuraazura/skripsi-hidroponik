@extends('layouts.base')

@section('title', 'Atur Tanaman')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Kendali</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">DataTables</li>
      </ol>
    </div>
    
      <!-- Horizontal Form -->
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pengaturan Tanaman</h6>
        </div>
        <div class="card-body">
          <form>
              <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kode Alat</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" value="2003R">
              </div>
              </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Tanaman</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" value="Selada">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Usia Tanaman</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" value="14 Hari">
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Ukuran Nutrisi</label>
                <div class="col-sm-4">
                    <small>Batas Minimum</small>
                    <input type="text" class="form-control" value="20 ppm">
                </div>
                <div class="col-sm-4">
                    <small>Batas Maksimum</small>
                    <input type="text" class="form-control" value="100 ppm">
                </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">Suhu</label>
              <div class="col-sm-4">
                <small>Suhu Minimum</small>
                <input type="text" class="form-control" value="27C">
            </div>
            <div class="col-sm-4">
                <small>Suhu Maksimum</small>
                <input type="text" class="form-control" value="30C">
              </div>
              </div>
            
              <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label" >Kelembapan Rockwoll</label>
                  <div class="col-sm-4">
                      <small>Kelembapan Minimum</small>
                      <input type="text" class="form-control" value="50%">
                    </div>
                    <div class="col-sm-4">
                        <small>Kelembapan Maksimum</small>
                        <input type="text" class="form-control" value="100%">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label" >Lampu Led</label>
                    <div class="col-sm-4">
                        <small>Waktu Hidup</small>
                        <input type="time" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <small>Waktu Mati</small>
                        <input type="time" class="form-control">
                    </div>
                </div>

            <div class="form-group row">
              <div class="col-sm-9">
            {{--  <div class="form-group row">
              <div class="col-sm-9">
                <a href="#" class="btn btn-sm btn-primary">Simpan</a>
              </div>
            </div>  --}}
            <a href="#" class="btn btn-primary mb-1">Simpan</a>
            <a href="#" class="btn btn-secondary mb-1">Kembali</a>
            </div>
            
          </form>
        </div>
      </div>
</div>

</div>


@endsection