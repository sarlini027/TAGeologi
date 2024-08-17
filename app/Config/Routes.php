<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\SeminarHasilController;
use App\Controllers\SeminarKemajuanController;
use App\Controllers\SidangAkhirController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// routes adalah controller mana yang akan merespon sebuah request, 
// misal ketika mengakses /homeadmin maka controlle yang akan digunakan adalah Admincontroller dan fungsi index


$routes->get('/', 'LandingPageController::index');

$routes->get('/auth/login', [AuthController::class, 'login'], ['filter' => 'guestfilter']);
$routes->post('/auth/login', [AuthController::class, 'login'], ['filter' => 'guestfilter']);
$routes->get('/auth/register', [AuthController::class, 'register'], ['filter' => 'guestfilter']);
$routes->post('/auth/register', [AuthController::class, 'register'], ['filter' => 'guestfilter']);

$routes->post('/auth/logout', [AuthController::class, 'logout'], ['filter' => 'authfilter']);

$routes->group('dashboard', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [DashboardController::class, 'index']);
});

$routes->group('seminar-kemajuan', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [SeminarKemajuanController::class, 'index']);
    $routes->post('/', [SeminarKemajuanController::class, 'store']);

    // List Pengajuan
    $routes->get('list-pengajuan', [SeminarKemajuanController::class, 'listPengajuan']);
});

$routes->group('seminar-hasil', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [SeminarHasilController::class, 'index']);
    $routes->post('/', [SeminarHasilController::class, 'store']);

    // List Pengajuan
    $routes->get('list-pengajuan', [SeminarHasilController::class, 'listPengajuan']);
});

$routes->group('sidang-akhir', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [SidangAkhirController::class, 'index']);
    $routes->post('/', [SidangAkhirController::class, 'store']);

    // List Pengajuan
    $routes->get('list-pengajuan', [SidangAkhirController::class, 'listPengajuan']);
});