<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('/', 'Admin::dashboard');

    $routes->group('users', function($routes) {
        $routes->get('/', 'AdminUser::index');
        $routes->add('create', 'AdminUser::create');
        $routes->add('edit/(:num)', 'AdminUser::edit/$1');
        $routes->get('delete/(:num)', 'AdminUser::delete/$1');
    });

    $routes->resource('fakultas', ['controller' => 'AdminFakultas']);
    $routes->resource('jurusan', ['controller' => 'AdminJurusan']);
    $routes->resource('prodi', ['controller' => 'AdminProdi']);
    $routes->resource('mahasiswa', ['controller' => 'AdminMahasiswa']);
});

$routes->group('mahasiswa', ['filter' => 'role:mahasiswa'], function($routes) {
    $routes->get('/', 'Mahasiswa::index');
    $routes->get('periode/(:num)', 'Mahasiswa::periode/$1');
    $routes->post('submit/(:num)', 'Mahasiswa::submit/$1');

    $routes->get('notifications', 'Mahasiswa::notifications');
    $routes->get('notifications/read/(:num)', 'Mahasiswa::readNotif/$1');
});
