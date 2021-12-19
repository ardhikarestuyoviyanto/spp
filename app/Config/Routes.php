<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('auth', function($routes){
	$routes->get('loginadmin', 'Home::loginadmin');
	$routes->get('loginsiswa', 'Home::loginsiswa');
	
});

$routes->group('admin', function($routes){
	//---------------------------------------------------------------
	$routes->get('home', 'Admin::home', ['filter'=>'auth']);
	//---------------------------------------------------------------------
	$routes->get('tahunajar', 'Admin::tahunajar', ['filter'=>'auth']);
	$routes->get('edittahunajar/(:any)', 'Admin::edittahunajar', ['filter'=>'auth']);
	//---------------------------------------------------------------------------
	$routes->get('datasiswa', 'Admin::datasiswa', ['filter'=>'auth']);
	$routes->get('tambahsiswa', 'Admin::tambahsiswa', ['filter'=>'auth']);
	$routes->get('editsiswa/(:any)', 'Admin::editsiswa', ['filter'=>'auth']);
	//---------------------------------------------------------------------------
	$routes->get('datakelas', 'Admin::datakelas', ['filter'=>'auth']);
	$routes->get('editkelas/(:any)', 'Admin::editkelas', ['filter'=>'auth']);
	//---------------------------------------------------------------------------
	$routes->get('pos', 'Admin::pos', ['filter'=>'auth']);
	$routes->get('tambahpos', 'Admin::tambahpos', ['filter'=>'auth']);
	$routes->get('editpos/(any)', 'Admin::editpos', ['filter' => 'auth']);
	//---------------------------------------------------------------------------
	$routes->get('kenaikankelas', 'Admin::kenaikankelas', ['filter'=>'auth']);
	$routes->get('kelulusan', 'Admin::kelulusan', ['filter'=>'auth']);
	//---------------------------------------------------------------------------
	$routes->get('tarif', 'Admin::tarif/(any)', ['filter'=>'auth']);
	$routes->get('settingtarif', 'Admin::settingtarif/(:any)', ['filter'=>'auth']);
	$routes->get('edittagihan', 'Admin::edittagihan/(:any)', ['filter'=>'auth']);
	$routes->get('settingTarif', 'Admin::settingTarif/(:any)', ['filter'=>'auth']);
	//---------------------------------------------------------------------------
	$routes->get('pembayaran', 'Admin::pembayaran', ['filter'=>'auth']);
	$routes->get('pembayaran/(:any)', 'Admin::pembayaran', ['filter'=>'auth']);
	$routes->get('bayarbulanan/(:any)/(:any)', 'Admin::bayarbulanan', ['filter'=>'auth']);
	$routes->get('bayarbebas/(:any)/(:any)', 'Admin::bayarbebas', ['filter'=>'auth']);
	//---------------------------------------------------------------------------
	$routes->add('multiitem', 'Admin::multiitem', ['filter'=>'auth']);
	//----------------------------------------------------------------------------
	$routes->get('users', 'Admin::users', ['filter'=>'auth']);
	$routes->get('tambahusers', 'Admin::tambahusers', ['filter'=>'auth']);
	$routes->get('editusers/(:any)', 'Admin::editusers', ['filter'=>'auth']);
	//----------------------------------------------------------------------------
	$routes->get('setting', 'Admin::setting', ['filter'=>'auth']);
	//--------------------------------------------------------------
	$routes->get('lapsiswa', 'Admin::lapsiswa', ['filter'=>'auth']);
	$routes->get('lapspp', 'Admin::lapspp', ['filter'=>'auth']);
	$routes->get('laplain', 'Admin::laplain', ['filter'=>'auth']);
	$routes->get('rekap', 'Admin::rekap', ['filter'=>'auth']);
	
	$routes->get('rekapdetail', 'Admin::rekapdetail', ['filter'=>'auth']);
	$routes->get('lapwalikelas', 'Admin::lapwalikelas', ['filter'=>'auth']);
	$routes->get('kartutag', 'Admin::kartutag', ['filter'=>'auth']);
	$routes->get('pemasukan', 'Admin::pemasukan', ['filter'=>'auth']);





});

//--------------------------------------------------------------
$routes->group('siswa', function($routes){
	$routes->get('home', 'Siswa::home', ['filter'=>'authsiswa']);
	$routes->get('tagihan', 'Siswa::tagihan', ['filter'=>'authsiswa']);
});
//--------------------------------------------------------------
$routes->group('export', function($routes){
	$routes->get('exporttagihanpersiswa/(:any)', 'Export::exporttagihanpersiswa', ['filter'=>'auth']);
	$routes->get('export_pertagihanbebas/(:any)/(:any)', 'Export::export_pertagihanbebas', ['filter'=>'auth']);
	$routes->get('export_pertagihanbulanan/(:any)/(:any)', 'Export::export_pertagihanbulanan', ['filter'=>'auth']);
	$routes->get('export_pertransaksibebas/(:any)/(:any)', 'Export::export_pertransaksibebas', ['filter'=>'auth']);
	$routes->get('export_pertransaksibulanan/(:any)/(:any)', 'Export::export_pertransaksibulanan', ['filter'=>'auth']);
	$routes->get('export_multibayar/(:any)/(:any)', 'Export::export_multibayar', ['filter'=>'auth']);
	$routes->get('exportbulanan_kelas', 'Export::exportbulanan_kelas', ['filter'=>'auth']);
	$routes->get('export_laplain', 'Export::export_laplain', ['filter'=>'auth']);
	$routes->get('export_rekap_bebas', 'Export::export_rekap_bebas', ['filter'=>'auth']);
	$routes->get('export_rekap_bulanan', 'Export::export_rekap_bulanan', ['filter'=>'auth']);

	$routes->get('export_rekap_det_bebas', 'Export::export_rekap_det_bebas', ['filter'=>'auth']);
	$routes->get('export_rekap_det_bulanan', 'Export::export_rekap_det_bulanan', ['filter'=>'auth']);
	$routes->get('export_lap_wali_kelas', 'Export::export_lap_wali_kelas', ['filter'=>'auth']);
	$routes->get('exportkartu/(:any)', 'Export::exportkartu', ['filter'=>'auth']);



	$routes->get('exportsiswa_pdf', 'Export::exportsiswa_pdf', ['filter'=>'auth']);
	$routes->get('exportsiswa_excel', 'Export::exportsiswa_excel', ['filter'=>'auth']);



});


$routes->get('/', 'Home::index');
$routes->get('/carisiswa', 'Home::carisiswa');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
