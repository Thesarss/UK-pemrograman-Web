<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
$routes->get('/', 'Home::index');

/*
|--------------------------------------------------------------------------
| AUTH ROUTE (optional)
|--------------------------------------------------------------------------
| Jika kamu pakai Auth controller dari Anggota 1
*/
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
| Role: admin
*/
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {

    // Dashboard
    $routes->get('/', 'Admin::dashboard');

    /*
    |-------------------------
    | USER MANAGEMENT
    |-------------------------
    */
    $routes->group('users', function($routes) {
        $routes->get('/', 'AdminUser::index');
        $routes->match(['get','post'], 'create', 'AdminUser::create');
        $routes->match(['get','post'], 'edit/(:num)', 'AdminUser::edit/$1');
        $routes->get('delete/(:num)', 'AdminUser::delete/$1');
    });

    /*
    |-------------------------
    | MASTER DATA (CRUD)
    |-------------------------
    */
    $routes->resource('fakultas', [
        'controller' => 'AdminFakultas',
        'except'     => 'show'
    ]);

    $routes->resource('jurusan', [
        'controller' => 'AdminJurusan',
        'except'     => 'show'
    ]);

    $routes->resource('prodi', [
        'controller' => 'AdminProdi',
        'except'     => 'show'
    ]);

    $routes->resource('mahasiswa', [
        'controller' => 'AdminMahasiswa',
        'except'     => 'show'
    ]);
});
