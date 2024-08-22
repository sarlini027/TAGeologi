<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\DataDosenController;
use App\Controllers\DataIndikatorPenilaianController;
use App\Controllers\DataMahasiswaController;
use App\Controllers\DataTemplateController;
use App\Controllers\NilaiSeminarHasilController;
use App\Controllers\NilaiSeminarKemajuanController;
use App\Controllers\NilaiSidangAkhirController;
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
    $routes->post('validasi/(:num)', [SeminarKemajuanController::class, 'validasi/$1']);

    // List Riwayat Pengajuan
    $routes->get('list-riwayat-pengajuan', [SeminarKemajuanController::class, 'listRiwayatPengajuan']);
});

$routes->group('seminar-hasil', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [SeminarHasilController::class, 'index']);
    $routes->post('/', [SeminarHasilController::class, 'store']);

    // List Pengajuan
    $routes->get('list-pengajuan', [SeminarHasilController::class, 'listPengajuan']);
    $routes->post('validasi/(:num)', [SeminarHasilController::class, 'validasi/$1']);

    // List Riwayat Pengajuan
    $routes->get('list-riwayat-pengajuan', [SeminarHasilController::class, 'listRiwayatPengajuan']);
});

$routes->group('sidang-akhir', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [SidangAkhirController::class, 'index']);
    $routes->post('/', [SidangAkhirController::class, 'store']);

    // List Pengajuan
    $routes->get('list-pengajuan', [SidangAkhirController::class, 'listPengajuan']);
    $routes->post('validasi/(:num)', [SidangAkhirController::class, 'validasi/$1']);

    // List Riwayat Pengajuan
    $routes->get('list-riwayat-pengajuan', [SidangAkhirController::class, 'listRiwayatPengajuan']);
});

$routes->group('data-mahasiswa', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [DataMahasiswaController::class, 'index']);
    $routes->post('/', [DataMahasiswaController::class, 'store']);
    $routes->post('update/(:num)', [DataMahasiswaController::class, 'update/$1']);
    $routes->post('delete/(:num)', [DataMahasiswaController::class, 'delete/$1']);
});

$routes->group('data-dosen', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [DataDosenController::class, 'index']);
    $routes->post('/', [DataDosenController::class, 'store']);
    $routes->post('update/(:num)', [DataDosenController::class, 'update/$1']);
    $routes->post('delete/(:num)', [DataDosenController::class, 'delete/$1']);
});

$routes->group('data-template-dokumen', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [DataTemplateController::class, 'index']);
    $routes->post('/', [DataTemplateController::class, 'store']);
    $routes->post('update/(:num)', [DataTemplateController::class, 'update/$1']);
    $routes->post('delete/(:num)', [DataTemplateController::class, 'delete/$1']);
});

$routes->group('indikator-penilaian', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [DataIndikatorPenilaianController::class, 'index']);
    $routes->post('/', [DataIndikatorPenilaianController::class, 'store']);
    $routes->post('update/(:num)', [DataIndikatorPenilaianController::class, 'update/$1']);
    $routes->post('delete/(:num)', [DataIndikatorPenilaianController::class, 'delete/$1']);

    // Detail
    $routes->get('detail/(:num)', [DataIndikatorPenilaianController::class, 'detail/$1']);
    $routes->post('detail/(:num)', [DataIndikatorPenilaianController::class, 'storeDetail/$1']);
    $routes->post('detail/update/(:num)', [DataIndikatorPenilaianController::class, 'updateDetail/$1']);
    $routes->post('detail/delete/(:num)', [DataIndikatorPenilaianController::class, 'deleteDetail/$1']); 
});

$routes->group('nilai-seminar-kemajuan', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [NilaiSeminarKemajuanController::class, 'index']);
    $routes->post('/', [NilaiSeminarKemajuanController::class, 'storeNilai']);
    $routes->post('update', [NilaiSeminarKemajuanController::class, 'updateNilai']);
});

$routes->group('nilai-seminar-hasil', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [NilaiSeminarHasilController::class, 'index']);
    $routes->post('/', [NilaiSeminarHasilController::class, 'storeNilai']);
    $routes->post('update', [NilaiSeminarHasilController::class, 'updateNilai']);
});

$routes->group('nilai-sidang-akhir', ['filter' => 'authfilter'], static function ($routes) {
    $routes->get('/', [NilaiSidangAkhirController::class, 'index']);
    $routes->post('/', [NilaiSidangAkhirController::class, 'storeNilai']);
    $routes->post('update', [NilaiSidangAkhirController::class, 'updateNilai']);
});