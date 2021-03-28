<?php

use App\LogMonitoring;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

//Admin
Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/beranda','BerandaController@index')->name('admin.beranda.index');

    //menajemen user
        Route::get('/manajemen_user','ManajemenUserController@index')->name('admin.manajemen_user.index');
        Route::get('/manajemen_user/tambah_user','ManajemenUserController@tambahUser')->name('admin.manajemen_user.tambah_user');
        Route::post('/manajemen_user/store','ManajemenUserController@store')->name('admin.manajemen_user.store');
        Route::post('/manajemen_user/destroy/{id}','ManajemenUserController@destroy')->name('admin.manajemen_user.destroy');
        Route::get('/manajemen_user/edit/{id}','ManajemenUserController@edit')->name('admin.manajemen_user.edit');
        Route::post('/manajemen_user/update/{id}','ManajemenUserController@update')->name('admin.manajemen_user.update');
    
    //manajemen alat
        Route::get('manajemen_alat/get_kode', 'ManajemenAlatController@get_kode')->name('get_kode_alat');
        Route::get('manajemen_alat/{user_id}', 'ManajemenAlatController@index')->name('admin.manajemen_alat.index');
        Route::post('manajemen_alat/{user_id}/store', 'ManajemenAlatController@store')->name('admin.manajemen_alat.store');
        Route::post('manajemen_alat/{alat_id}/destroy', 'ManajemenAlatController@destroy')->name('admin.manajemen_alat.destroy');
        // Route::get('manajemen_alat/get_kode', 'ManajemenAlatController@get_kode');

    // monitoring
        Route::get('/monitoring','MonitoringController@index')->name('admin.monitoring.index');
        Route::get('monitoring/daftar-alat/{user_id}','MonitoringController@daftarAlat')->name('admin.monitoring.daftar_alat');
        Route::get('/log-monitoring/{kode_alat}','MonitoringController@log')->name('admin.monitoring.log_monitoring');
        Route::get('/log-monitoring/get-data/{kode_alat}', 'MonitoringController@get_data')->name('admin.monitoring.log_monitoring.get-data');
    // profil
        Route::get('profil','ProfilController@index')->name('admin.profil.index');
        Route::get('edit-profil/{id}','ProfilController@edit')->name('admin.profil.edit');
        Route::post('update-profil/{id}','ProfilController@update')->name('admin.profil.update');
    });

    
//petani
    Route::group(['prefix' => 'petani', 'namespace' => 'petani', 'middleware' => 'auth'], function () {
        Route::get('/beranda','BerandaController@index')->name('petani.beranda.index');
        //monitoring
        Route::get('/monitoring','MonitoringController@index')->name('petani.monitoring.index');
        Route::get('/log-monitoring/{kode_alat}','MonitoringController@log')->name('petani.monitoring.log_monitoring');
        Route::get('/log-monitoring/get-data/{kode_alat}', 'MonitoringController@get_data')->name('petani.monitoring.log_monitoring.get-data');

        //kendali
        Route::get('/kendali','ManajemenAlatController@index')->name('petani.kendali.index');
        Route::get('/kendali/{kode_alat}','ManajemenAlatController@atur_tanaman')->name('petani.kendali.atur_tanaman');
        Route::post('/kendali/{id_alat}', 'ManajemenAlatController@update')->name('petani.kendali.atur_tanaman.atur');
        Route::get('/kendali/edit/','AlatController@edit')->name('petani.kendali.edit');
        
        //profil
        Route::get('profil','ProfilController@index')->name('petani.profil.index');
        Route::get('edit-profil/{id}','ProfilController@edit')->name('petani.profil.edit');
        Route::post('update-profil/{id}', 'ProfilController@update')->name('petani.update-profil');
// Route::get('kirim-data/{kodeAlat}','KirimDataController@cekData');

    });

    Route::get('cek-waktu', function () {
        $waktusekarang = date("d-m-Y H:i:s");
        return $waktusekarang;

        
    });


    Route::get('normalisasi', function () {
        $datas = DB::table('log_monitoring')
                    ->where('created_at', '>=', '2021-02-22 00:01')
                    ->where('created_at', '<=', '2021-02-22 01:00:00')
                    // ->where('created_at', 'like', '%2021-02-20%')
                    // ->where('nutrisi_air', '>=', 400)
                    ->get();
        
        // return $datas;
        foreach ($datas as $key => $data) {

            // DB::table('log_monitoring')->where('id', $data->id)->update([
                // 'pompa_siram' => 1
                // 'lampu_led' => 0
            // ]);
            // if ($data->nutrisi_air > 300) {
            //     $nut = $data->nutrisi_air - 40;
    
            // }

            // if ($data->nutrisi_air > 400) {
            //     $nut = $data->nutrisi_air - 100;
    
            //     DB::table('log_monitoring')->where('id', $data->id)->update([
            //         'nutrisi_air' => $nut
            //     ]);
            // }

            // // if ($data->nutrisi_air < 60) {
                // $nut = $data->nutrisi_air - 100;
    
                // DB::table('log_monitoring')->where('id', $data->id)->update([
                //     'nutrisi_air' => $nut
                // ]);
            // }
       
         }
        return 'success';
    });

    Route::get('lihat-data', function () {
        return $datas = DB::table('log_monitoring')->where('created_at', 'LIKE', '%2021-02-16%')->get();
    });

    Route::get('unix-timestamps', function () {
        $datas = DB::table('log_monitoring')->get();

        foreach ($datas as $key => $data) {
            DB::table('log_monitoring_unix_timestamps')->insert([
                'kode_alat' => $data->kode_alat,
                'kelembapan_air' => $data->kelembapan_air,
                'nutrisi_air' => $data->nutrisi_air,
                'suhu_air' => $data->suhu_air,
                'suhu_udara' => $data->suhu_udara,
                'kelembaban_udara' => $data->kelembaban_udara,
                'created_at' => $data->created_at,
                'kipas_pendingin' => $data->kipas_pendingin,
                'pompa_nutrisi' => $data->pompa_nutrisi,
                'pompa_air' => $data->pompa_air,
                'pompa_siram' => $data->pompa_siram,
                'lampu_led' => $data->lampu_led,
                'created_at' => $data->created_at,
                'unix_timestamps' => strtotime($data->created_at),
                'updated_at' => $data->updated_at,
            ]);
        }
        return 'jaha';
    });

    Route::get('haha', function () {
        $datas = DB::table('log_monitoring_backup')->get();

        foreach ($datas as $key => $data) {
            DB::table('log_monitoring')->where('id', $data->id)->update([
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ]);
        }
        return 'haha';
    });

    Route::get('json', function () {
        $path = "./log_monitoring.json";
        $json = json_decode(file_get_contents($path), true);
        // return $json[2]['data'];

        foreach ($json[2]['data'] as $key => $val) {
            DB::table('log_monitoring')->insert([
                'kode_alat' => $val['kode_alat'],
                'kelembapan_air' => $val['kelembapan_air'],
                'suhu_air' => $val['suhu_air'],
                'nutrisi_air' => $val['nutrisi_air'],
                'suhu_udara' => $val['suhu_udara'],
                'kelembaban_udara' => $val['kelembaban_udara'],
                'kipas_pendingin' => $val['kipas_pendingin'],
                'pompa_nutrisi' => $val['pompa_nutrisi'],
                'pompa_air' => $val['pompa_air'],
                'pompa_siram' => $val['pompa_siram'],
                'lampu_led' => $val['lampu_led'],
                'created_at' => $val['created_at'],
                'updated_at' => $val['updated_at'],
            ]);
        }
    });

    Route::get('salin-data', function () {
        $datas = DB::table('log_monitoring_backup_server')->where('kode_alat', 'A_3')->orderBy('id', 'asc')->get();
        foreach ($datas as $key => $data) {
            DB::table('log_monitoring')->insert([
                'kode_alat' => $data->kode_alat,
                'kelembapan_air' => $data->kelembapan_air,
                'suhu_air' => $data->suhu_air,
                'nutrisi_air' => $data->nutrisi_air,
                'suhu_udara' => $data->suhu_udara,
                'kelembaban_udara' => $data->kelembaban_udara,
                'kipas_pendingin' => $data->kipas_pendingin,
                'pompa_nutrisi' => $data->pompa_nutrisi,
                'pompa_air' => $data->pompa_air,
                'pompa_siram' => $data->pompa_siram,
                'lampu_led' => $data->lampu_led,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ]);
        }
        return 'success';
    });