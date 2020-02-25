<?php 

use Phlacon\Mvc\Model;

class EmployeeprojectController extends ControllerBase
{

    public function indexAction()
    {
        $employee = EmployeeProject::find();
        return json_encode($employee);
    }

    public function createAction()
    {
    	$employee = new Employeeproject();
    	$employee->project_name = $this->request->getPost("project_name");
     	$employee->start_date = $this->request->getPost("start_date");
     	$employee->end_date = $this->request->getPost("end_date");
        $employee->project_lead = $this->request->getPost("project_lead");
     	$employee->project_technology = $this->request->getPost("project_technology");
     	$employee->updated_date = $this->request->getPost("updated_date");
     	$employee->created_date = $this->request->getPost("created_date");
     	if (!$employee->create()) 
         {
            return "Data Not Inserted.";
         }
        else
         {  
            echo json_encode($employee);
            return "Data successfully inserted";
         }
     
    }
    
}
