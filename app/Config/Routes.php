<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ==== ANTRIAN ====
$routes->get('api/antrian', 'AntrianController::index'); // Melihat semua antrian
$routes->get('api/antrian/menunggu', 'AntrianController::menunggu'); // Melihat yang masih menunggu
$routes->post('api/antrian', 'AntrianController::create'); // Tambah antrian baru
$routes->post('api/antrian/panggil', 'AntrianController::panggil'); // Panggil antrian
$routes->post('api/antrian/next', 'AntrianController::next'); // Panggil berikutnya
$routes->post('api/antrian/reset', 'AntrianController::reset'); // Reset antrian
$routes->post('/api/antrian/panggil-ulang', 'AntrianController::panggilUlang');
$routes->post('/api/antrian/selesai', 'AntrianController::selesai');


// ==== LOKET ====
$routes->get('api/loket', 'LoketController::index'); // Lihat daftar loket

// ==== LOG ====
$routes->get('api/log', 'LogAntrianController::index'); // Lihat log aktivitas

// ==== USER ====
$routes->post('api/login', 'UserController::login'); // Login user/operator
$routes->post('api/login', 'Api\Auth::login');
$routes->group('api/operator', function($routes) {
    $routes->post('panggil', 'Api\Operator::panggil');
    $routes->post('panggil-ulang', 'Api\Operator::panggilUlang');
    $routes->post('selesaikan', 'Api\Operator::selesaikan');
    $routes->post('lewati', 'Api\Operator::lewati');
    $routes->get('loket', 'Api\Operator::loketAktif');
});

// ==== OPERATOR (untuk tampilan web) ====
$routes->get('/operator/login', 'OperatorController::login');
$routes->post('/operator/auth', 'OperatorController::auth');
$routes->get('/operator/dashboard', 'OperatorController::dashboard');
$routes->get('/operator/logout', 'OperatorController::logout');
$routes->get('operator/pilihLoket', 'OperatorController::pilihLoket');
$routes->post('operator/setLoket', 'OperatorController::setLoket');
$routes->get('operator', 'OperatorController::index');
$routes->get('operator/select', 'OperatorController::select');
$routes->get('operator/getLoketByJenis/(:segment)', 'OperatorController::getLoketByJenis/$1');
$routes->post('operator/setOperatorSession', 'OperatorController::setOperatorSession');
$routes->get('logoutOperator', 'OperatorController::logoutOperator');

// API untuk Operator
$routes->post('api/operator/panggil', 'Api\Operator::panggil');
$routes->post('api/operator/panggilSelanjutnya', 'Api\Operator::panggilSelanjutnya');
$routes->post('api/operator/panggilUlang', 'Api\Operator::panggilUlang');
$routes->post('api/operator/selesai', 'Api\Operator::selesai');
$routes->post('api/operator/resetAntrian', 'Api\Operator::resetAntrian');
$routes->get('api/loket/byJenis/(:segment)', 'Api\LoketController::byJenis/$1');

