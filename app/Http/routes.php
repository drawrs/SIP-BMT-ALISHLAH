
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

Route::get('/home', 'HomeController@index');
Route::get('/jam', 'MainController@jam');
Route::get('/askXa=as-xXasak1!2023k', [
        'uses' => 'MainController@getMaster',
        'as' => 'master.tambah'
        ]);
Route::post('/askXa=as-xXasak1!2023k', [
        'uses' => 'MainController@postMaster',
        'as' => 'karyawan.master-post'
        ]);
Route::group(['middleware' => ['auth']], function (){
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::get('/home', [
        'uses' => 'MainController@home',
        'as' => 'home']);
    Route::post('/absen_now', [
        'uses' => 'MainController@absen_now',
        'as' => 'absen.now'
        ]);
    Route::get('/absen_detail/{id?}', [
        'uses' => 'MainController@data_absen',
        'as' => 'absen.detail'
        ]);
    Route::get('/absen_detail/edit/{id}', [
        'uses' => 'AdminController@getEditAbsen',
        'as' => 'absen.edit'
        ]);
    Route::post('/absen_detail/edit', [
        'uses' => 'AdminController@postEditAbsen',
        'as' => 'absen.post-edit'
        ]);
    Route::get('/absen_detail/add/{id}', [
        'uses' => 'AdminController@getAddAbsen',
        'as' => 'absen.add'
        ]);
    Route::post('/absen_detail/add/{id}', [
        'uses' => 'AdminController@postAddAbsen',
        'as' => 'absen.post-add'
        ]);
    Route::get('/absen_detail/del/{id}', [
        'uses' => 'AbsenController@getDelAbsen',
        'as' => 'absen.get-del'
        ]);


    Route::get('/cuti', [
        'uses' => 'MainController@cuti',
        'as' => 'cuti'
        ]);
    Route::post('/cuti_temp', [
        'uses' => 'MainController@cuti_temp',
        'as' => 'cuti.add_temp'
        ]);
    Route::post('/cuti_send', [
        'uses' => 'MainController@cuti_send',
        'as' => 'cuti.send_temp'
        ]);
    Route::post('/cuti_batal', [
        'uses' => 'MainController@cuti_batal',
        'as' => 'cuti.batal'
        ]);
    Route::post('/cuti/update', [
        'uses' => 'AdminController@cuti_update',
        'as' => 'cuti.update'
        ]);
    Route::post('/report-absen', [
        'uses' => 'AdminController@printReportAbsen',
        'as' => 'absen.print-report'
        ]);
    Route::get('/report/absen', [
        'uses' => 'AdminController@report_absen',
        'as' => 'report.absen',
        'middleware' => 'admin'
        ]);
    Route::get('/report/karyawan', [
        'uses' => 'AdminController@report_karyawan',
        'as' => 'report.karyawan',
        'middleware' => 'admin'
        ]);
    Route::post('/report-karyawan', [
        'uses' => 'AdminController@printReportKaryawan',
        'as' => 'karyawan.print-report',
        'middleware' => 'admin'
        ]);
    Route::get('/cuti-req', [
        'uses' => 'AdminController@cuti_req',
        'as' => 'cuti.request',
        'middleware' => 'admin'
        ]);
    Route::post('/permohonan-cuti', [
        'uses' => 'AdminController@cuti_aksi',
        'as' => 'cuti.aksi',
        'middleware' => 'admin'
        ]);
    Route::get('/cuti/print/{id?}', [
        'uses' => 'AdminController@printCuti',
        'as' => 'cuti.print-cuti',
        'middleware' => 'admin'
        ]);
    Route::get('/karyawan', [
        'uses' => 'AdminController@karyawan',
        'as' => 'karyawan',
        'middleware' => 'admin'
        ]);
   Route::get('/karyawan/tambah', [
        'uses' => 'AdminController@getAddKaryawan',
        'as' => 'karyawan.tambah',
        'middleware' => 'admin'
        ]);
     Route::post('/karyawan/tambah', [
        'uses' => 'AdminController@postAddKaryawan',
        'as' => 'karyawan.tambah-post',
        'middleware' => 'admin'
        ]);
     Route::get('/karyawan/edit/{id}', [
        'uses' => 'AdminController@getEditKaryawan',
        'as' => 'karyawan.edit',
        'middleware' => 'admin'
        ]);
     Route::post('/karyawan/edit/{id}', [
        'uses' => 'AdminController@postEditKaryawan',
        'as' => 'karyawan.edit-post',
        'middleware' => 'admin'
        ]);
     Route::post('/karyawan/gantipw', [
        'uses' => 'AdminController@gantiPwd',
        'as' => 'karyawan.gantipw',
        'middleware' => 'admin'
        ]);
     Route::post('/karyawan/hapus', [
        'uses' => 'AdminController@hapusUser',
        'as' => 'karyawan.hapus',
        'middleware' => 'admin'
        ]);
     Route::post('/cabang/add', [
        'uses' => 'AdminController@postAddCabang',
        'as' => 'cabang.add',
        'middleware' => 'admin'
        ]);
     Route::post('/cabang/del', [
        'uses' => 'AdminController@postDelCabang',
        'as' => 'cabang.del',
        'middleware' => 'admin'
        ]);
     Route::post('/jabatan/add', [
        'uses' => 'AdminController@postAddJabatan',
        'as' => 'jabatan.add',
        'middleware' => 'admin'
        ]);
     Route::post('/jabatan/del', [
        'uses' => 'AdminController@postDelJabatan',
        'as' => 'jabatan.del',
        'middleware' => 'admin'
        ]);
     Route::post('/status/add', [
        'uses' => 'AdminController@postAddStatus',
        'as' => 'status.add',
        'middleware' => 'admin'
        ]);
     Route::post('/status/del', [
        'uses' => 'AdminController@postDelStatus',
        'as' => 'status.del',
        'middleware' => 'admin'
        ]);
    Route::get('/cuti_out_batal', [
        'uses' => 'MainController@cuti_out_batal',
        'as' => 'cuti_out.batal',
        'middleware' => 'admin'
        ]);
});
     /*Route::get('/cek', function(){
        return view('tes');
     });*/
     Route::get('/cek', 'MainController@tos');
     


Route::group(['middleware' => 'hrd'], function(){
         Route::post('/cek-posting', 'MainController@postCekPosting');
         Route::get('/cek-posting', 'MainController@postCekPosting');
         Route::get('/error-message', 'PriodeController@getErrorMessage');
         Route::any('/refresh', [
            'uses' => 'AdminController@postRefreshAbsen',
            'as' => 'refresh.absen']);
         Route::get('/rekap-gaji/posting', [
            'uses' => 'PriodeController@getPostingAbsen',
            'as' => 'rekap.posting'/*,
            'middleware' => 'admin'*/
            ]);
         Route::any('/rekap-gaji/posting_all', [
            'uses' => 'MainController@postCekPostingAll',
            'as' => 'rekap.posting-all'/*,
            'middleware' => 'admin'*/
            ]);
         Route::get('/rekap-gaji/user/{id}', [
            'uses' => 'PriodeController@getListUser',
            'as' => 'rekap.list'/*,
            'middleware' => 'admin'*/
            ]);
         Route::get('/rekap-gaji/bulan/{id?}', [
            'uses' => 'PriodeController@getListBulan',
            'as' => 'rekap.bulan'/*,
            'middleware' => 'admin'*/
            ]);
         
         Route::get('/rekap-gaji/priode/del/{rekap_id}', [
            'uses' => 'PriodeController@getDelRekap',
            'as' => 'rekap.del'/*,
            'middleware' => 'admin'*/
            ]);
         Route::get('/rekap-gaji/restore-all', [
            'uses' => 'PriodeController@getRestoreRekapAll',
            'as' => 'rekap.restore-all'/*,
            'middleware' => 'admin'*/
            ]);
         Route::get('/rekap-gaji/priode/resore/{rekap_id}', [
            'uses' => 'PriodeController@getRestoreRekap',
            'as' => 'rekap.restore'/*,
            'middleware' => 'admin'*/
            ]);
          Route::get('/print-rekap', [
            'uses' => 'PriodeController@getPrintRekap',
            'as' => 'rekap.priode.print'/*,
            'middleware' => 'admin'*/
            ]);
          Route::get('/print-rekap-absen', [
            'uses' => 'PriodeController@getPrintRekapAbsen',
            'as' => 'rekap.priode.print-absen'/*,
            'middleware' => 'admin'*/
            ]);
         Route::get('/gaji', [
            'uses' => 'GajiController@index',
            'as' => 'gaji']);
         Route::post('/gaji', [
            'uses' => 'GajiController@postEnterPIN']);
         Route::post('/gaji/edit', [
            'uses' => 'GajiController@postEdit',
            'as' => 'gaji.edit']);

         Route::get('/potongan', [
            'uses' => 'GajiController@indexPotongan',
            'as' => 'potongan']);
         Route::any('/potongan/edit', [
            'uses' => 'GajiController@postEditPotongan',
            'as' => 'potongan.edit']);
        // batalin cuti yang udah acc
        Route::get('/cuti_out_batal', [
            'uses' => 'MainController@cuti_out_batal',
            'as' => 'cuti_out.batal'
            ]);
});

Route::get('/print-struk-gaji', [
            'uses' => 'PriodeController@getPrintStruk',
            'as' => 'rekap.struk.print'/*,
            'middleware' => 'admin'*/
            ]);
Route::get('/rekap-absensiku', [
            'uses' => 'PriodeController@getRekapAbsensiku',
            'as' => 'rekap.absensiku'/*,
            'middleware' => 'admin'*/
            ]);
Route::get('/rekap-gaji/priode/{rekap_id}', [
            'uses' => 'PriodeController@getViewRekap',
            'as' => 'rekap.priode'/*,
            'middleware' => 'admin'*/
            ]);
Route::get('/rekap-gaji/priode-by-date/{user_id}', [
            'uses' => 'PriodeController@getViewRekapByDate',
            'as' => 'rekap.priodeByDate'/*,
            'middleware' => 'admin'*/
            ]);