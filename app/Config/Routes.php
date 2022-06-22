<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('');
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//pake filter untuk session nya, untuk cek sudah login atau belum di file Filters.php

/////////////////////////////////////////////////////
// BAGIAN PASIEN
////////////////////////////////////////////////////
$routes->get('/', 'HomeController::indexHome');
$routes->get('/selesai', 'HomeController::selesai');

// pengajuan konsultasi 
$routes->get('/pengajuan', 'HomeController::index');
$routes->post('/pengajuan/process', 'HomeController::processKonsultasi');
$routes->get('/pengajuan/hasilKonsultasi', 'HomeController::halamanHasilKonsultasi');
$routes->get('/pengajuan/hasilKonsultasi/cetakHasil', 'HomeController::halamanCetakHasilKonsultasi');

// riwayat 
$routes->get('/riwayat', 'HomeController::indexriwayat');
$routes->get('/riwayat/detail/(:alphanum)', 'HomeController::detailriwayat/$1');

// download 
$routes->get('/download', 'HomeController::indexdownload');
$routes->get('/download/cetakHasilDownload/(:alphanum)', 'HomeController::cetakHasilDownload/$1');

// janji temu dengan dokter
$routes->get('/janjitemu', 'HomeController::indexjanjitemu');
$routes->post('/janjitemu/process', 'HomeController::processjanjitemu');
$routes->get('/janjitemu/hasilJanjiTemu', 'HomeController::halamanHasilJanjiTemu');
$routes->get('/janjitemu/hasilJanjiTemu/cetakHasil', 'HomeController::halamanCetakHasilJanjiTemu');


//////////////////// bagian login ////////////////////
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

//////////////////// bagian Registrasi dan Profil////////////////////
$routes->get('/registrasi', 'RegistrasiController::index');
$routes->post('/registrasi/process', 'RegistrasiController::process');
$routes->get('/profil', 'RegistrasiController::indexProfilUser');
$routes->post('/profil/processEditProfil', 'RegistrasiController::processEditProfil');
$routes->get('/ubahKataSandi', 'RegistrasiController::indexUbahKataSandi');
$routes->post('/ubahKataSandi/processUbahKataSandi', 'RegistrasiController::processUbahKataSandi');
$routes->post('/lupaPassword/process', 'RegistrasiController::processLupaPassword');
$routes->get('/dashboard', 'DashboardController::index');

/////////////////////////////////////////////////////
// BAGIAN ADMIN
////////////////////////////////////////////////////

//bagian User
$routes->get('/user', 'UserController::index');
$routes->post('/user/processTambah', 'UserController::processTambah');
$routes->post('/user/processEdit', 'UserController::processEdit');
$routes->post('/user/delete', 'UserController::delete');

//bagian Pasien
$routes->get('/pasien', 'PasienController::index');
$routes->post('/pasien/processTambah', 'PasienController::processTambah');
$routes->post('/pasien/processEdit', 'PasienController::processEdit');
$routes->post('/pasien/delete', 'PasienController::delete');

// bagian dokter
$routes->get('dokter', 'DokterController::index');
$routes->post('dokter/processTambah', 'DokterController::processTambah');
$routes->post('dokter/processEdit', 'DokterController::processEdit');
$routes->post('dokter/delete', 'DokterController::delete');

//bagian Jadwal Janji Temu
$routes->get('/jadwal', 'JadwalController::index');
$routes->post('/jadwal/processTambah', 'JadwalController::processTambah');
$routes->post('/jadwal/processEdit', 'JadwalController::processEdit');
$routes->post('/jadwal/delete', 'JadwalController::delete');

//bagian Konsultasi tidak terpakai
$routes->get('/konsultasi', 'KonsultasiController::index');
$routes->post('/konsultasi/processTambah', 'KonsultasiController::processTambah');
$routes->post('/konsultasi/processEdit', 'KonsultasiController::processEdit');
$routes->post('/konsultasi/delete', 'KonsultasiController::delete');



/////////////////////////////////////////////////////
// BAGIAN PAKAR
////////////////////////////////////////////////////
//bagian gejala
$routes->get('/gejala', 'GejalaController::index');
$routes->post('/gejala/processTambah', 'GejalaController::processTambah');
$routes->post('/gejala/processEdit', 'GejalaController::processEdit');
$routes->post('/gejala/delete', 'GejalaController::delete');

//bagian Penyakit
$routes->get('/penyakit', 'PenyakitController::index');
$routes->post('/penyakit/processTambah', 'PenyakitController::processTambah');
$routes->post('/penyakit/processEdit', 'PenyakitController::processEdit');
$routes->post('/penyakit/delete', 'PenyakitController::delete');

//bagian Aturan
$routes->get('/aturan', 'AturanController::index');
$routes->post('/aturan/processTambah', 'AturanController::processTambah');
$routes->post('/aturan/processEdit', 'AturanController::processEdit');
$routes->post('/aturan/delete', 'AturanController::delete');









// $routes->group('', ['filter' => 'usersAuth'], function ($routes) {
//     $routes->get('/dashboard', 'User::index');
// });


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
