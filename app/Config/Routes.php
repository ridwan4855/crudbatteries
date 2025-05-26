<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('batteries', function($routes) {
    $routes->get('/', 'Batteries::index');
    $routes->get('create', 'Batteries::create');
    $routes->post('store', 'Batteries::store');
    $routes->get('edit/(:num)', 'Batteries::edit/$1');
    $routes->put('update/(:num)', 'Batteries::update/$1');
    $routes->get('delete/(:num)', 'Batteries::delete/$1');
});