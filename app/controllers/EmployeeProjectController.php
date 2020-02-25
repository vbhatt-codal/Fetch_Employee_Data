<?php 

use Phlacon\Mvc\Model;

class EmployeeProjectController extends ControllerBase
{

    public function indexAction($id)
    {
        $employee = EmployeeProject::findFirst($id);
        // get the (single) category that is related to this job
        $employee = $employee->getRelated('employee');
    	  $this->view->employee=$employee;
        return json_encode($employee);
    }

    public function createAction()
    {
    	$employee = new EmployeeProject();
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
