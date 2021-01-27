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
                    <div class="col-md-12">
                      <div class="form-group row mb-0">
                          <label class="col-md-3 col-form-label" style="margin-right: -5%;">Pilih Rentang Waktu Mulai</label>
                          <div class="col-md-3">
                              <input type="date" name="tanggal_mulai" id="tanggal-mulai" class="form-control" placeholder="" aria-describedby="helpId">
                          </div>
                          
                          <label class="col-md-1 col-form-label text-center" style="margin-right: -23px; margin-left: -23px;">s/d</label>
                          <div class="col-md-3">
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
                          {{-- <th>Status Heater</th> --}}
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
  var url = '{{ url("admin/log-monitoring/get-data") }}'
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
      { data: 'nama_tanaman', name: 'nama_tanaman', orderable: false },
      { data: 'usia_tanaman', name: 'usia_tanaman', orderable: false },
      { data: 'waktu_pembacaan', name: 'waktu_pembacaan', orderable: false },
      { data: 'kelembapan_air', name: 'kelembapan_air', orderable: false },
      { data: 'suhu_ruangan', name: 'suhu_ruangan', orderable: false },
      { data: 'nutrisi_air', name: 'nutrisi_air', orderable: false },
      { data: 'pompa_siram', name: 'pompa_siram', orderable: false },
      { data: 'kipas_pendingin', name: 'kipas_pendingin', orderable: false },
      { data: 'pompa_nutrisi', name: 'pompa_nutrisi', orderable: false },
      { data: 'lampu_led', name: 'lampu_led', orderable: false },
    ]
  })

  $('#tanggal-mulai').on('change', function (e) {
    table.draw()
    console.log('mulai', $('input[name=tanggal_mulai]').val())
    e.preventDefault();
  })

  $('#tanggal-akhir').on('change', function (e) {
    table.draw()
    e.preventDefault();
  })
</script>
@endpush