<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return redirect('/docs');
});

// auth route
$router->post("/register", "AuthController@register");
$router->post("/login", "AuthController@login");
$router->get("/logout", "AuthController@logout");
$router->post("/user/update/{id}", "AuthController@update");
$router->get("/user/get/{id}", "AuthController@show");

// product route
$router->get('product', 'ProductsController@getAll');
$router->post('/product/store', 'ProductsController@createData');
$router->get('/product/get/{id}', 'ProductsController@getId');
$router->post('/product/update/{id}', 'ProductsController@editData');
$router->delete('/product/delete/{id}', 'ProductsController@deleteData');

// contact route
$router->get('contact', 'ContactsController@getAllPaginate');
$router->get('contact/all', 'ContactsController@getAll');
$router->post('/contact/store', 'ContactsController@createData');
$router->get('/contact/get/{id}', 'ContactsController@getId');
$router->put('/contact/update/{id}', 'ContactsController@editData');
$router->delete('/contact/delete/{id}', 'ContactsController@deleteData');
$router->get('contact/count', 'ContactsController@countData');

// job route
$router->get('job', 'JobsController@getAll');
$router->post('/job/store', 'JobsController@createData');
$router->get('/job/get/{id}', 'JobsController@getId');
$router->put('/job/update/{id}', 'JobsController@editData');
$router->delete('/job/delete/{id}', 'JobsController@deleteData');

// radio route
$router->get('radio', 'RadiosController@getAll');
$router->post('/radio/store', 'RadiosController@createData');
$router->get('/radio/get/{id}', 'RadiosController@getId');
$router->put('/radio/update/{id}', 'RadiosController@editData');
$router->delete('/radio/delete/{id}', 'RadiosController@deleteData');

// radio coverage route
$router->get('radiocoverage', 'RadioCoveragesController@getAll');
$router->post('/radiocoverage/store', 'RadioCoveragesController@createData');
$router->get('/radiocoverage/get/{id}', 'RadioCoveragesController@getId');
$router->put('/radiocoverage/update/{id}', 'RadioCoveragesController@editData');
$router->delete('/radiocoverage/delete/{id}', 'RadioCoveragesController@deleteData');
$router->get("/printradio/{provinsi}", "GeneratesController@printPDF");

// user route
$router->get('user', 'UserController@getAll');
$router->post('user/store', 'UserController@createData');
$router->get('user/get/{id}', 'UserController@show');
$router->put('/userupdate/{id}', 'UserController@editData');
$router->delete('/user/delete/{id}', 'UserController@deleteData');

// digital ads route
$router->get('ads', 'DigitalAdsController@getAll');
$router->post('ads/store', 'DigitalAdsController@createData');
$router->get('ads/get/{id}', 'DigitalAdsController@getId');
$router->post('/ads/update/{id}', 'DigitalAdsController@editData');
$router->delete('/ads/delete/{id}', 'DigitalAdsController@deleteData');
