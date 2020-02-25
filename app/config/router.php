<?php
use Phalcon\Mvc\Router;
//$di->set('router', function() {
    $router = new Router();

//$router = $di->getRouter();

//Get one element. Ex: /user/asdads,dfg.78dgd*dfg
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "index"
));

$router->addPost('/:controller/', array(
    'controller' => 1,
    'action'     => "create"
));

// $router->addGet('/Employee', array(
//      'controller' => "Employeeproject",
//      'action'     => "index"
//  ));

// $router->addPost('/Employee', array(
//      'controller' => "Employeeproject",
//      'action'     => "create"
//  ));
// Define your routes here

//$router->handle();
return $router;