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
$routes->get('/', 'Home::index');

// user
$routes->group('', ['filter' => 'AuthCheck'], function($routes){
	$routes->get('/user', 'User::index');
	$routes->get('/user/karyaTerkirim', 'User::karyaTerkirim');
	$routes->get('/user/editProfile', 'User::editProfile');

	$routes->get('/karyatulis/createkaryatulis', 'KaryaTulis::createKaryaTulis');
	$routes->get('/karyatulis/savekaryatulis', 'KaryaTulis::saveKaryaTulis');
});

// login
$routes->group('', ['filter' => 'LoginCheck'], function($routes){
	$routes->get('/auth', 'Auth::index');
	$routes->get('/auth/registrasi', 'Auth::registrasi');
});

// admin
$routes->group('', ['filter' => 'AdminCheck'], function($routes){
	$routes->get('/admin', 'Admin::index');
	
	$routes->get('/auth/ubahPasswordOlehAdmin/(:any)', 'Auth::ubahPasswordOlehAdmin/$1');
});

// admin master
$routes->group('', ['filter' => 'AdminMasterCheck'], function($routes){
	$routes->get('/admin/admin', 'Admin::admin');
	$routes->get('/admin/save', 'Admin::save');
	$routes->get('/admin/delete', 'Admin::delete');
	$routes->get('/admin/edit/(:any)', 'Admin::edit/$1');
	$routes->get('/admin/editSave/(:any)', 'Admin::editSave/$1');
});

// bothCheck
$routes->group('', ['filter' => 'BothCheck'], function($routes)
{
	$routes->get('/auth/ubahPassword', 'Auth::ubahPassword');
	$routes->get('/auth/konfirmasiPassword', 'Auth::konfirmasiPassword');
	$routes->get('/auth/passwordBaru', 'Auth::passwordBaru');
	$routes->get('/auth/savePasswordBaru', 'Auth::savePasswordBaru');
});

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
