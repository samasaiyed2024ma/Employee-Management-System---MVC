<?php

use Ems\Controllers\EmployeeController;
use Ems\Controllers\AdminLoginController;
use Ems\Controller;
use Ems\Router;

$router = new Router();

$router->get('/dashboard', EmployeeController::class, 'index');
$router->get('/create', EmployeeController::class, 'add');
$router->get('/view', EmployeeController::class, 'view');
$router->get('/edit', EmployeeController::class, 'edit');
$router->get('/registration', AdminLoginController::class, 'registration');
$router->get('/login', AdminLoginController::class, 'login');

$router->post('/store', EmployeeController::class, 'store');
$router->post('/update', EmployeeController::class, 'update');
$router->post('/delete', EmployeeController::class, 'delete');
$router->post('/registration', AdminLoginController::class, 'storeRegData');
$router->post('/login', AdminLoginController::class, 'loginAdmin');


$router->dispatch();
