<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//routes untuk bendahara
$routes->get('pembayaran','PembayaranController::index');
$routes->get('pembayaran/(:num)','PembayaranController::show/$1');
$routes->post('pembayaran','PembayaranController::create');
$routes->put('pembayaran/(:num)','PembayaranController::update/$1');
$routes->delete('pembayaran/(:num)','PembayaranController::delete/$1');

//routes untuk kepala sekolah
$routes->get('headmaster','HeadmasterController::index');

//routes untuk siswa
$routes->get('siswa/(:num)','SiswaController::show/$1');

