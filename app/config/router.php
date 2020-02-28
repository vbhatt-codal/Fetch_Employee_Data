<?php
use Phalcon\Mvc\Router;
//$di->set('router', function() {
    $router = new Router();

//$router = $di->getRouter();


$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "index"
));

$router->addPost('/:controller/', array(
    'controller' => 1,
    'action'     => "create"
));

$router->addPut('/:controller/{id:[0-9]+}', array(
    'controller' => 1,
    'action'     => "update"
));

$router->addDelete('/:controller/{id:[0-9]+}', array(
    'controller' => 1,
    'action'     => "delete"
));

//$router->handle();
return $router;