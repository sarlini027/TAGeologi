<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
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
