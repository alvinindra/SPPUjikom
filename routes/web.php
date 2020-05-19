<?php

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

Auth::routes();

Route::middleware(['auth:web'])->group(function () {

    //Home
    Route::get('/', 'HomeController@dashboard')->name('users.dashboard');
    Route::Post('cetak-laporan-harian', 'HomeController@cetak')->name('laporan-harian.cetak');
    Route::Post('export-laporan-harian', 'HomeController@export')->name('laporan-harian.export');

    //Admin & Petugas
    Route::get('/manage/users', 'UserController@manage_users')->name('admin.manage.users');
    Route::get('/user/add', 'UserController@create_user')->name('admin.create.user');
    Route::post('/user/add', 'UserController@store_user')->name('admin.store.user');
    Route::get('/user/edit/{user}', 'UserController@edit_user')->name('admin.edit.user');
    Route::post('/user/edit/{user}', 'UserController@update_user')->name('admin.update.user');
    Route::post('/user/delete/{user}', 'UserController@delete_user')->name('admin.delete.user');

    //Transaksi SPP
    Route::get('/spp/transaksi', 'TransaksiController@index')->name('transaksi.index');
    Route::get('/spp/pay/{id}', 'TransaksiController@pay')->name('transaksi.pay');
    Route::get('/spp/cancel/{id}', 'TransaksiController@cancel')->name('transaksi.cancel');
    Route::post('print-spp/{id}', 'TransaksiController@print')->name('transaksi.cetak');
    Route::get('export-transaksi/{id}', 'TransaksiController@export')->name('transaksi.export');

    //SPP
    Route::get('/manage/spp', 'SppController@manage_spp')->name('spp.manage');
    Route::get('/spp/add', 'SppController@create')->name('spp.create');
    Route::post('/spp/add', 'SppController@store')->name('spp.store');
    Route::get('spp/edit/{id}', 'SppController@edit')->name('spp.edit');
    Route::post('spp/edit/{id}', 'SppController@update')->name('spp.update');
    Route::post('spp/delete/{id}', 'SppController@delete')->name('spp.delete');

    //Siswa
    Route::get('/manage/siswa', 'SiswaController@manage_siswa')->name('siswa.manage');
    Route::get('/siswa/add', 'SiswaController@create')->name('siswa.create');
    Route::post('/siswa/add', 'SiswaController@store')->name('siswa.store');
    Route::get('siswa/detail/{id}', 'SiswaController@show')->name('siswa.show');
    Route::get('siswa/edit/{id}', 'SiswaController@edit')->name('siswa.edit');
    Route::post('siswa/edit/{id}', 'SiswaController@update')->name('siswa.update');
    Route::post('siswa/delete/{id}', 'SiswaController@delete')->name('siswa.delete');
    Route::get('export-siswa', 'SiswaController@export')->name('siswa.export');

    //Kelas
    Route::get('/manage/kelas', 'KelasController@manage_kelas')->name('kelas.manage');
    Route::get('/kelas/add', 'KelasController@create')->name('kelas.create');
    Route::post('/kelas/add', 'KelasController@store')->name('kelas.store');
    Route::get('kelas/edit/{id}', 'KelasController@edit')->name('kelas.edit');
    Route::post('kelas/edit/{id}', 'KelasController@update')->name('kelas.update');
    Route::post('kelas/delete/{id}', 'KelasController@delete')->name('kelas.delete');
});
