<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Entries');
$routes->setDefaultMethod('list');
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
$routes->get('login', 'Login::index', ['filter' => 'noauth']);


// I removed this because I didn't know how to apply filters on some of the resources!
// $routes->resource('entries');

$routes->get('/', 'Entries::index', ['filter' => 'auth']);
$routes->get('entries/(:segment)', 'Entries::show/$1', ['filter' => 'auth']);
$routes->get('entries/new', 'Entries::new', ['filter' => 'admin_check']);
$routes->post('entries', 'Entries::create', ['filter' => 'admin_check']);
$routes->get('entries/(:segment)/edit', 'Entries::edit/$1', ['filter' => 'admin_check']);
$routes->post('/entries/update_entry/(:int)', 'Entries::update_entry', ['filter' => 'admin_check']);
$routes->delete('entries/(:segment)', 'Entries::delete/$1', ['filter' => 'admin_check']);
$routes->post('/entries/excel_export', 'Entries::excel_export', ['filter' => 'auth']);


$routes->get('/users', 'User::index', ['filter' => 'admin_check']);
$routes->get('/users/new', 'User::new', ['filter' => 'admin_check']);
$routes->post('/users/create', 'User::create', ['filter' => 'admin_check']);
$routes->get('/users/edit/', 'User::edit', ['filter' => 'admin_check']);
$routes->post('/users/update', 'User::update', ['filter' => 'admin_check']);

// $routes->resource('photos');

// // Equivalent to the following:
// $routes->get('photos/new',             'Photos::new');
// $routes->post('photos',                'Photos::create');
// $routes->get('photos',                 'Photos::index');
// $routes->get('photos/(:segment)',      'Photos::show/$1');
// $routes->get('photos/(:segment)/edit', 'Photos::edit/$1');
// $routes->put('photos/(:segment)',      'Photos::update/$1');
// $routes->patch('photos/(:segment)',    'Photos::update/$1');
// $routes->delete('photos/(:segment)',   'Photos::delete/$1');

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
