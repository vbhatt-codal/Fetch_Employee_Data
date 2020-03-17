<?php
use Phalcon\Mvc\Router;
//$di->set('router', function() {
    $router = new Router();

//$router = $di->getRouter();

// ----------Employee CRUD routes----------
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "index"
));

$router->addGet('/employee/{id:[0-9]+}', array(
    'controller' => "Employee",
    'action'     => "findbyid"
));


// ----------Project CRUD routes----------
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "index"
));

$router->addGet('/project/{id:[0-9]+}', array(
    'controller' => "Project",
    'action'     => "findById"
));

$router->addPost('/controller:([a-zA-Z0-9\_\-]+)/([a-zA-Z0-9_-]+)', array(
    'controller' => 1,
    'action'     => "save"
));

$router->addPut('/{controller:([a-zA-Z0-9\_\-]+)}/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "update",
 ));

$router->addDelete('/{controller:([a-zA-Z0-9\_\-]+)}/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "delete",
 ));


//-----------Employee_project relation CRUD routes------------
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "indexrelation"
));

$router->addPost('/:controller/', array(
    'controller' => "Employeeprojectrelation",
    'action'     => "createrelation"
));
$router->addPut('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "update",
 ));

$router->addDelete('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "delete",
 ));
//employee/id/project
$router->addGet('/Employee/{id:[0-9]+}/project', array(
    'controller'    => "Employeeprojectrelation",
    'action'        => "getprojectbyemployee",
    'id'            => 2
));

//project/id/employee
$router->addGet('/Project/{id:[0-9]+}/employee', array(
    'controller'    => "Employeeprojectrelation",
    'action'        => "getemployeebyproject", 
    'id'            => 2
));

//$router->handle();
return $router;

