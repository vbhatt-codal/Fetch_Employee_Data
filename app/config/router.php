<?php
use Phalcon\Mvc\Router;
//$di->set('router', function() {
    $router = new Router();

//$router = $di->getRouter();

$router->addGet('/Employee', array(
     'controller' => "Employee",
     'action'     => "index"
 ));
// Define your routes here

//$router->handle();
return $router;