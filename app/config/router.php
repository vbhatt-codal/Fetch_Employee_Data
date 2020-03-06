<?php
use Phalcon\Mvc\Router;
//$di->set('router', function() {
    $router = new Router();

//$router = $di->getRouter();

// ----------Employee_project CRUD route----------
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "index"
));

$router->addGet('/project/{id:[0-9]+}', array(
    'controller' => "Project",
    'action'     => "findbyid"
));

$router->addPost('/:controller/', array(
    'controller' => 1,
    'action'     => "create"
));

$router->addPut('/:controller/update/{id:[0-9]+}', array(
    'controller' => 1,
    'action'     => "update"
));

$router->addDelete('/:controller/delete/{id:[0-9]+}', array(
    'controller' => 1,
    'action'     => "delete"
));


//-----------Employee_project relation------------
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "indexrelation"
));

$router->addPost('/:controller/', array(
    'controller' => 1,
    'action'     => "createrelation"
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

