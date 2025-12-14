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
//routes analytic
$routes->group('report', ['filter' => 'auth'], function($routes) {
    $routes->get('kaprodi/(:num)', 'Report::kaprodi/$1');
    $routes->get('pimpinan/(:num)', 'Report::pimpinan/$1');
    $routes->get('exportExcel/(:num)', 'Report::exportExcel/$1');
    $routes->get('exportPdf/(:num)', 'Report::exportPdf/$1');
});
