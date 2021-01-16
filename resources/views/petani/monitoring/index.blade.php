@extends('layouts.base')

@section('title', 'Monitoring')

@section('content')
<div class="container-fluid" id="container-wrapper">
  <input type="hidden" name="" id="user_id" value="{{ $user }}">
  <div class="row">
  @forelse ($data_alat as $dataAlat)
    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
      <div class="card">
        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-light">Kode Alat {{ $dataAlat->kode_alat }}</h6>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Nama Tanaman</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="namaTanaman">{{$dataAlat->nama_tanaman}}</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Usia Tanaman</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="usiaTanaman">{{ App\Helpers::dateDiff($dataAlat->created_at) }} Hari</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Suhu Udara</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'suhuUdara_'.$dataAlat->kode_alat}}">0 C</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Kelembapan Rockwool
                </div>
                <div class="small text-gray-500 message-time" id="{{'kelembapanRockwool_'.$dataAlat->kode_alat}}">0 %</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Suhu Air
                </div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'suhuAir_'.$dataAlat->kode_alat}}">0 C</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Nutrisi Air
                </div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'nutrisiAir_'.$dataAlat->kode_alat}}">0 ppm</div>
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Kipas</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'kipas_'.$dataAlat->kode_alat}}"></div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Pompa Nutrisi</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'pompaNutrisi_'.$dataAlat->kode_alat}}"></div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Pompa Air</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'pompaAir_'.$dataAlat->kode_alat}}"></div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Pompa Siram</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'pompaSiram_'.$dataAlat->kode_alat}}"></div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Lampu Led</div>
                <div class="small text-gray-500 message-time font-weight-bold" id="{{'lampuLed_'.$dataAlat->kode_alat}}"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-footer text-center">
              <a class="m-0 small text-primary card-link" href="{{route('petani.monitoring.log_monitoring',$dataAlat->kode_alat)}}">Lihat Log Monitoring <i
                  class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-xl-12 col-md-12 mb-12">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2 text-center">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Data monitoring belum tersedia</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforelse
  </div>
</div>
@endsection

@push('script')
<script>
  const userId = $('#user_id').val()
  var url = "{{ url('/api/get-data') }}"

  setInterval(() => {
    $.getJSON(url+ '/' +userId, function (d) {
      // console.log('data', d)
      d.forEach(item => {
        $('#suhuUdara_'+item.kode_alat).html(item.suhu_udara+ ' C')
        $('#kelembapanRockwool_'+item.kode_alat).html(item.kelembapan_air+ ' %')
        $('#suhuAir_'+item.kode_alat).html(item.suhu_air+ ' C')
        $('#nutrisiAir_'+item.kode_alat).html(item.nutrisi_air+ ' ppm')

        $('#kipas_'+item.kode_alat).html(statusUbah(item.kipas_pendingin))
        $('#pompaNutrisi_'+item.kode_alat).html(statusUbah(item.pompa_nutrisi))
        $('#pompaAir_'+item.kode_alat).html(statusUbah(item.pompa_air))
        $('#pompaSiram_'+item.kode_alat).html(statusUbah(item.pompa_siram))
        $('#lampuLed_'+item.kode_alat).html(statusUbah(item.lampu_led))
      });
    })
  }, 2000);
  
  function statusUbah(i) {
    if (i === 0) {
      return "Mati";
    } else {
      return "Hidup";
    }
  }

</script>
@endpush