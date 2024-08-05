<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// routes adalah controller mana yang akan merespon sebuah request, 
// misal ketika mengakses /homeadmin maka controlle yang akan digunakan adalah Admincontroller dan fungsi index


$routes->get('/', 'UserController::index');
