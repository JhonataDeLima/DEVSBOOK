<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');

$router->get('/cadastro', 'LoginController@signup');
$router->post('/cadastro', 'LoginController@signupAction');

//$rouser->get('/pesquisar')
//$rouser->get('/perfil')
//$rouser->get('/sair')
//$rouser->get('/amigos')
//$rouser->get('/fotos')
//$rouser->get('/config')