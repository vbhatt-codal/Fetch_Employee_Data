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
    'controller' => "Employeeproject",
    'action'     => "findbyid"
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

//-----------Employee_project relation------------

// $router->addGet('/:controller/:action/:param', array(
//     'controller'    => 1,
//     'action'        => 2,
//     'param'			=> 3
//    // 'id'            => 2,
//     //'relationship'  => 3
// ));


$router->addGet('/:controller/', array(
    'controller' => 1,
    'action'     => "indexrelation"
));
/*
$router->add(
    "/documentation/{chapter}/{name}\.{type:[a-z]+}",
    [
        "controller" => "documentation",
        "action"     => "show",
    ]
);*/


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
// $router->addGet('/:controller/([a-zA-Z0-9\_\-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9\_\-]+)', array(
//     'controller'    => 1,
//     'action'        => "get",
//     'id'            => 2,
//     'relationship'  => 3,
//     'related_item'  => 4
// ));
// $router->addGet('/:controller/([a-zA-Z0-9\_\-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9\_\-]+)', array(
//     'controller'    => 1,
//     'action'        => "getEmployee",
//     'id'            => 2,
//     'relationship'  => 3,
//     'related_item'  => 4
// ));

//$router->handle();
return $router;






// { department/2/user
//   "items": [
//     {
//       "department_id": 1,
//       "department_name": "JS",
//       "department_lead": 25,
//       "first_name_of_lead": "Vashram",
//       "last_name_of_lead": "Berani"
//     },
//     {
//       "department_id": 4,
//       "department_name": "PHP",
//       "department_lead": 1,
//       "first_name_of_lead": "soham",
//       "last_name_of_lead": "bhatt"
//     },
//     {
//       "department_id": 5,
//       "department_name": "Management",
//       "department_lead": 21,
//       "first_name_of_lead": "Danny",
//       "last_name_of_lead": "Goyal"
//     },