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
    'action'     => "create"
));

//Project/Update/{id}
$router->addPut('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "update",
 ));

//Project/delete/{id}
$router->addDelete('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "delete",

 ));



//-----------Employee_project_relation  routes------------
$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "indexRelation"
));

//Employeeprojectrelation/getSumOfAllocation/5
$router->addGet('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "getSumOfAllocation"
));

$router->addPost('/:controller', array(
    'controller' => "Employeeprojectrelation",
    'action'     => "projectAllocation",
));

$router->addPut('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "update",
 ));
//update allocation 20+20 =40
$router->addPut('/allocation/{id:[0-9]+}', array(
    'controller' => "Employeeprojectrelation",
    'action'     => "updateAllocation",
));

$router->addDelete('/{controller:([a-zA-Z0-9\_\-]+)}/([a-zA-Z0-9_-]+)/{id:([a-zA-Z0-9-_]+)}', array(
    'controller' => 1,
    'action'     => "delete",
 ));
//employee/id/project
$router->addGet('/Employee/{id:[0-9]+}/project', array(
    'controller'    => "Employeeprojectrelation",
    'action'        => "getProjectByEmployee",
    'id'            => 2
));

//project/id/employee
$router->addGet('/Project/{id:[0-9]+}/employee', array(
    'controller'    => "Employeeprojectrelation",
    'action'        => "getEmployeeByProject", 
    'id'            => 2
));


//$router->handle();
return $router;

