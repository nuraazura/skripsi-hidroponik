@extends('layouts.base')

@section('title', 'Log Monitoring')

@section('content')
<div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Monitoring {{ $alat->kode_alat }}</h1>
      </div>
        <!-- Row -->
      <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Monitoring </h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal-mulai" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal-akhir" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                </div>
              </div>
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTableMonitoring">
                  <thead class="thead-light">
                    <tr>
                      {{-- <th>No</th> --}}
                      <th>Nama Tanaman</th>
                      <th>Usia Tanaman</th>
                      <th>Waktu Pembacaan</th>
                      <th>Kelembapan Rockwool</th>
                      <th>Suhu Ruangan</th>
                      <th>Nutrisi Air</th>
                      <th>Status Pompa Siram</th>
                      <th>Status Kipas</th>
                      <th>Status Heater</th>
                      <th>Status Pompa Nutrisi</th>
                      <th>Status Lampu Led</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
          <!-- Documentation Link -->
</div>
@endsection

@push('script')
<script>
  var url = '{{ url("petani/log-monitoring/get-data") }}'
  var kodeAlat = "{{ $alat->kode_alat }}"
  var ajaxUrl = url+'/'+kodeAlat

  var table = $('#dataTableMonitoring').DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    ajax: {
      url: ajaxUrl,
      data: function (d) {
        d.tanggal_mulai =  $('input[name=tanggal_mulai]').val()
        d.tanggal_akhir =  $('input[name=tanggal_akhir]').val()
      },
      // success: function (data) {
      //   console.log('ajaxdata', data)
      // }
    },
    columns: [
      // { data: 'rownum', name: 'rownum' },
      { data: 'nama_tanaman', name: 'nama_tanaman' },
      { data: 'usia_tanaman', name: 'usia_tanaman' },
      { data: 'waktu_pembacaan', name: 'waktu_pembacaan' },
      { data: 'kelembapan_air', name: 'kelembapan_air' },
      { data: 'suhu_ruangan', name: 'suhu_ruangan' },
      { data: 'nutrisi_air', name: 'nutrisi_air' },
      { data: 'pompa_siram', name: 'pompa_siram' },
      { data: 'kipas_pendingin', name: 'kipas_pendingin' },
      { data: 'kipas_pemanas', name: 'kipas_pemanas' },
      { data: 'pompa_nutrisi', name: 'pompa_nutrisi' },
      { data: 'lampu_led', name: 'lampu_led' },
    ]
  })

  $('#tanggal-mulai').on('change', function (e) {
    table.draw()
    e.preventDefault();
  })

  $('#tanggal-akhir').on('change', function (e) {
    table.draw()
    e.preventDefault();
  })
</script>
@endpush