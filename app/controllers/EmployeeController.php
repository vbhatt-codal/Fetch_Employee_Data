<?php 

use Phlacon\Mvc\Model;

class EmployeeController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $employee = Employee::find();
    	  $this->view->employee=$employee;
        return json_encode($employee);
    }


}