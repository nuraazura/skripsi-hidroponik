@extends('layouts.base')

@section('title', 'Pengaturan Tanaman')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Kendali {{$alat->kode_alat}}</h1>
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="./">Home</a></li> --}}
        {{-- <li class="breadcrumb-item">Tables</li> --}}
        {{-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> --}}
      </ol>
    </div>
    
      <!-- Horizontal Form -->
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pengaturan Tanaman</h6>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('petani.kendali.atur_tanaman.atur', $alat->id)}}">
            @csrf
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Tanaman</label>
              <div class="col-sm-4">
                  {{-- <small>Batas Minimum</small> --}}
                  <input type="text" class="form-control" name="nama_tanaman" value="{{$alat->nama_tanaman}}">
                  {{-- <small>Kurang dari minimum pompa nutrisi akan aktif</small> --}}
              </div>
          </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Ukuran Nutrisi</label>
                <div class="col-sm-4">
                    <small>Batas Minimum</small>
                    <input type="number" class="form-control" name="nutrisi_min" value="{{$alat->nutrisi_min}}">
                    <small>Kurang dari minimum pompa nutrisi akan aktif</small>
                  </div>
                  <div class="col-sm-4">
                    <small>Batas Maksimum</small>
                    <input type="number" class="form-control" name="nutrisi_max" value="{{$alat->nutrisi_max}}">
                    <small>Lebih dari maksimum pompa air akan aktif</small>
                </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">Suhu</label>
              {{-- <div class="col-sm-4"> --}}
                {{-- <small>Suhu Minimum</small> --}}
                {{-- <input type="number" class="form-control" name="suhu_udara_min" value="{{$alat->suhu_udara_min}}"> --}}
                {{-- <small>Kurang dari minimum heater akan aktif</small> --}}
            {{-- </div> --}}
            <div class="col-sm-4">
                <small>Suhu Maksimum</small>
                <input type="number" class="form-control" name="suhu_udara_max" value="{{$alat->suhu_udara_max}}">
                <small>Lebih dari maksimum kipas angin akan aktif</small>
              </div>
              </div>
            
              {{-- <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label" >Kelembapan Rockwoll</label>
                  <div class="col-sm-4">
                      <small>Kelembapan Minimum</small>
                      <input type="number" class="form-control" name="kelembapan_min" value="{{$alat->kelembapan_min}}">
                      <small>Kurang dari minimum pompa siram aktif</small>
                    </div>
                </div> --}}
                
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label" >Kontrol Lampu </label>
                    <div class="col-sm-4">
                        <small>Waktu Hidup</small>
                        <input type="time" class="form-control" name="lampu_hidup" value="{{$alat->lampu_hidup}}">
                    </div>
                    <div class="col-sm-4">
                        <small>Waktu Mati</small>
                        <input type="time" class="form-control" name="lampu_mati" value="{{$alat->lampu_mati}}">
                    </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label" >Kontrol Waktu Penyiraman</label>
                  <div class="col-sm-4">
                      <small>Waktu Penyiraman Mulai</small>
                      <input type="time" class="form-control" name="waktu_penyiraman_mulai" value="{{$alat->waktu_penyiraman_mulai}}">
                  </div>
                  <div class="col-sm-4">
                      <small>Waktu Penyiraman Selesai</small>
                      <input type="time" class="form-control" name="waktu_penyiraman_selesai" value="{{$alat->waktu_penyiraman_selesai}}">
                  </div>
              </div>

            <div class="form-group row">
              <div class="col-sm-9">
            {{--  <div class="form-group row">
              <div class="col-sm-9">
                <a href="#" class="btn btn-sm btn-primary">Simpan</a>
              </div>
            </div>  --}}
            <button class="btn btn-primary " type="submit">Simpan</button>
            {{-- <a href="#" class="btn btn-primary mb-1"></a> --}}
            {{-- <a href="#" class="btn btn-secondary mb-1">Kembali</a> --}}
            </div>
            
          </form>
        </div>
      </div>
</div>

</div>


@endsection