<?php

use Illuminate\Http\Request;

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

Route::group(['api' => 'SppController'], function () {
    Route::middleware('auth:api')->post('/spp/list', "SppController@api_list_spp")->name('api.list.dataspp');
});

Route::group(['api' => 'SiswaController'], function () {
    Route::middleware('auth:api')->post('/siswa/list', "SiswaController@api_list_siswa")->name('api.list.datasiswa');
    Route::middleware('auth:api')->post('/siswa/edit/{id}', 'SiswaController@api_edit_siswa')->name('api.siswa.edit');
});

Route::group(['api' => 'KelasController'], function () {
    Route::middleware('auth:api')->post('/kelas/list', "KelasController@api_list_kelas")->name('api.list.datakelas');
});
