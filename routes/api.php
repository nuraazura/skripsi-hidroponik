<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// fix yg di pakai untuk kirim data dari alat
Route::get('kirim-data/{kodeAlat}/{kelembapan_air}/{nutrisi_air}/{suhu_air}/{suhu_udara}/{kelembaban_udara}', 'KirimDataController@kirim_data');

// fix yg dipakai untuk req status alat dri alat
Route::get('get-status/kipas-pendingin/{kodeAlat}', 'KendaliController@kipasPendingin');
Route::get('get-status/kipas-pemanas/{kodeAlat}', 'KendaliController@kipasPemanas');
Route::get('get-status/led/{kodeAlat}', 'KendaliController@led');
Route::get('get-status/pompa-siram/{kodeAlat}', 'KendaliController@pompaSiram');
Route::get('get-status/pompa-nutrisi/{kodeAlat}', 'KendaliController@pompaNutrisi');
Route::get('get-status/pompa-air/{kodeAlat}', 'KendaliController@pompaAir');
Route::get('get-status/kontrol/{kodeAlat}', 'KendaliController@statusKontrol');

// Route::get('log-monitoring/{kodeAlat}/{kelembapan}/{nutrisi}/{suhu}', 'KirimDataController@inputLog');
Route::get('log-monitoring/{kode_alat_id}/{suhu_udara}/{kelembapan}/{nutrisi}','MonitoringAlatController@logMonitoring');
Route::get('monitoring/{kode_alat_id}/{suhu_udara}/{kelembapan}/{nutrisi}','MonitoringAlatController@monitoring');

Route::get('get-data/{user_id}', 'MonitoringAlatController@getData');