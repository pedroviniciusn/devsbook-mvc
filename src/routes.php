<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');
$router->get('/logout', 'LoginController@logout');

$router->get('/register', 'LoginController@signup');
$router->post('/register', 'LoginController@signupAction');

$router->get('/profile', 'ProfileController@index');
$router->get('/profile/follow/{id}', 'ProfileController@follow');

$router->get('/photos', 'ProfileController@photos');

$router->get('/friends', 'ProfileController@friends');



$router->post('/post', 'PostController@create');