<?php

/**
  * @SWG\Definition(definition="Employeeprojectrelation", type="object",
  *     @SWG\Property(property="id", type="integer"),
  *     @SWG\Property(property="project_code", type="integer"),
  *     @SWG\Property(property="employee_id", type="integer"),
  *     @SWG\Property(property="start_date", type="string"),
  *     @SWG\Property(property="end_date", type="string"),
  *     @SWG\Property(property="work_alloted", type="integer"),
  *     @SWG\Property(property="work_alloted_description", type="string"),
  *     @SWG\Property(property="updated_date", type="string"),
  *     @SWG\Property(property="created_date", type="string"),
  * )
 */

use Phlacon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;
use Phalcon\Http\Request;

class EmployeeprojectrelationController extends ControllerBase
{
    // use MysqlControllerTrait;
     protected $id;
     protected $project_code;

    
    /**
     * @SWG\Get(
     *     tags={"EmployeeProjectRelation"},
     *     path="/Employeeprojectrelation/indexRelation",
     *     description="Returns a Relation between employee and project based on a single ID",
     *     summary="Get Employee Project Deatils",
     *     operationId="GetEmployee",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *          response=200,
     *          description="department response",
     *          @SWG\Schema(ref="#/definitions/Employeeprojectrelation")
     *     ),
     *     @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authorization header"
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="unexpected error",
     *     )
     * )
     */
    public function indexRelationAction()
    {
        $relation = Employeeprojectrelation::find();
        return $this->response->setJsonContent($relation);
    }

     /**
     * @SWG\Post(path="/Employeeprojectrelation/projectAllocation",
     *   tags={"EmployeeProjectRelation"},
     *   summary="Create a new Employee Project Allocation",
     *   description="create new employee",
     *   summary="create employee",
     *   operationId="CreateEmployee",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="insert record",
     *     required=false,
     *     @SWG\Schema(ref="#/definitions/Employeeprojectrelation")
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="successful operation",
     *   ),
     *   @SWG\Response(
     *         response="400",
     *         description="Invalid data supplied"
     *   ),
     *   @SWG\Response(
     *       response=500,
     *       description="unexpected error",
     *   ),
     *   @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authorization header"
     *   )
     * )
     */ 
    public function projectAllocationAction()
    {   
       
        $data =$this->request->getJsonRawBody();

        $employeeCode = $data->employee_code;
        $startDate = $data->start_date;
        $endDate = $data->end_date;
        $workAlloted = $data->work_alloted;
        

        $obj = Employee::findFirst([

           "conditions" => "employee_code =".$employeeCode,
        ]);

        // return $this->response->setJsonContent($obj);

        $params = [
            'models' => 'Employeeprojectrelation'
        ];

        $builder = new Builder($params);
        $builder->columns(['SUM(work_alloted) as total'])
                ->from('Employeeprojectrelation');

        if(isset($obj->id)) 
        {
              
            $builder->where("employee_id = ".$obj->id)        
                     ->andWhere("start_date between '".$startDate."'  AND '".$endDate."'")
                      // ->andWhere("end_date between '" .$endDate. '" AND "' .$startDate"'")
                     ->groupBy('employee_id'); 
            
        }  
     
        else
        {
            echo "improper id please enter any integer type id";
        }

        $result = $builder->getQuery()->execute()->toArray();
        // return $this->response->setJsonContent($result);   
    
        
        $sum =$result[0]['total'] + $workAlloted;
            
        if($sum >= 100)
        {
            return "Error: your total work allocation is exceeding 100%"; 
        }

        if($workAlloted <= 1 )
        {
            return "Error: you have to allocate minimun 1% work";
        }
        
        if($workAlloted >= 100)
        {
            return "Error:you can not allocate more than 100%";
        }    

        else
        {   

            $relation = new Employeeprojectrelation();
            $relation->id = $data->id;
            $relation->project_code = $data->project_code;
            $relation->employee_id = $data->employee_code;
            $relation->start_date = $data->start_date;
            $relation->end_date = $data->end_date;
            $relation->work_alloted = $data->work_alloted;
            $relation->work_alloted_description = $data->work_alloted_description;
            $relation->updated_date = date('Y-m-d H:i:s');
            $relation->created_date = date('Y-m-d H:i:s');
            
            if (!$relation->save()) 
            {
                 return $this->response->setJsonContent("Data Not Inserted.");
            }
            else
            {  
                 return $this->response->setJsonContent($relation);
            }   
        }     
    }

     /**
     * @SWG\Put(path="/EmployeeProjectRelation/update/{id}",
     *   tags={"EmployeeProjectRelation"},
     *   summary="Update an existing employee project details",
     *   description="Update existing employee project details",
     *   operationId="Update Relation Detials",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *    @SWG\Parameter(
     *     description="ID of Employee Project Relation",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Update Employee Project Relation details",
     *     required=false,
     *     @SWG\Schema(ref="#/definitions/Employeeprojectrelation")
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="successful operation",
     *   ),
     *   @SWG\Response(
     *         response="400",
     *         description="Invalid data supplied",
     *   ),
     *   @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authorization header",
     *   ),
     *   @SWG\Response(
     *         response="404",
     *         description="ID Not Found",
     *   ),
     *   @SWG\Response(
     *         response="500",
     *         description="unexpected error",
     *   )
     * )
     */

    public function updateAction($id)
    {
        $data =$this->request->getJsonRawBody();

        $relation = Employeeprojectrelation::findFirst($id);
          
        $relation->project_code = $data->project_code;
        $relation->employee_id = $data->employee_id;
        $relation->start_date = $data->start_date;
        $relation->end_date = $data->end_date;
        $relation->work_alloted = $data->work_alloted;
        $relation->work_alloted_description = $data->work_alloted_description;
        $relation->created_date = date('Y-m-d H:i:s');
        $relation->updated_date = date('Y-m-d H:i:s');

        if (!$relation->update()) 
        {
            return $this->response->setJsonContent("Data not updated");
        }
        else
        {  
            return $this->response->setJsonContent($relation);
        }               
    }

     /**
     * @SWG\Delete(
     *     tags={"EmployeeProjectRelation"},
     *     path="/Employeeprojectrelation/delete/{id}",
     *     description="deletes a single relation record based on the ID",
     *     summary="delete Relation data",
     *     operationId="Delete Employee Project Relation",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of relation data to be delete",
     *         format="int64",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="Relation Record deleted",
     *         @SWG\Schema(type="null")
     *     ),
     *     @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authorization header",
     *     ),
     *   @SWG\Response(
     *         response="404",
     *         description="ID Not Found",
     *   ),
     *     @SWG\Response(
     *         response="500",
     *         description="unexpected error",
     *     )
     * )
     */
    public function deleteAction($id)
    {
        $relation = Employeeprojectrelation::findFirst($id);
        if(!$relation->delete())
        {
           return $this->response->setJsonContent("Data not deleted");
        }
        else
        {  
           return $this->response->setJsonContent($relation);
        } 
    }


    /**
     * @SWG\Get(
     *     tags={"EmployeeProjectRelation"},
     *     path="/Employee/{id}/project",
     *     description="Returns all department from the system that the user has access to",
     *     summary="Get the employee project relation data",
     *     operationId="GetRelationData",
     *     produces={"application/json"},
     *    @SWG\Parameter(
     *     description="ID of Employee project",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="holiday response",
     *         @SWG\Schema(ref="#/definitions/Employeeprojectrelation")
     *     ),
     *     @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authentication header"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="unexpected error",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
     *     )
     * )
     */
    public function getProjectByEmployeeAction($id)
    {             
       
        $request = new Request();
        
        $params = [
            'models' => 'Employee'
        ];

        $data = $this->getProjectList($params,$id); 
        if(isset($data))
        {
            return $this->response->setJsonContent($data);
        }
        else
        {
            return $this->sendForbidden();
        }
        
    }
   
    public function getProjectList($params, $id)
    {       
         
        $builder = new Builder($params);
        $builder->columns([
           // "Employee.*,Project.*,Employeeprojectrelation.*"
            "Employee.id, Employee.employee_code, Employee.user_name, Project.project_code, Project.project_name, Project.project_lead, Project.project_technology, Project.start_date, Project.end_date, Employeeprojectrelation.id, Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
 
        $builder->Join("Project","Employee.id =Project.project_lead");
        $builder->Join("Employeeprojectrelation", "Employee.id =Employeeprojectrelation.employee_id");

        if(isset($id)  && is_numeric($id) && $id > 0)
        {
            $builder->where("Employee.id = ".$id); //Employee.id = which is change to EPR.id
        }  
        else
        {
            echo "improper id please enter any integer type id";
        }

        $data = $builder->getQuery()->execute()->toArray();
        return $data;
    
    }

    /**
     * @SWG\Get(
     *     tags={"EmployeeProjectRelation"},
     *     path="/Project/{id}/employee",
     *     description="Returns all department from the system that the user has access to",
     *     summary="Get the employee project relation data",
     *     operationId="GetRelationData",
     *     produces={"application/json"},
     *    @SWG\Parameter(
     *     description="ID of Employee project",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="holiday response",
     *         @SWG\Schema(ref="#/definitions/Employeeprojectrelation")
     *     ),
     *     @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authentication header"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="unexpected error",
     *         @SWG\Schema(ref="#/definitions/ErrorResponse")
     *     )
     * )
     */
    public function getEmployeeByProjectAction($project_code)
    {             
        $request = new Request();

        $params = [
            'models' => 'Employee'
        ];

        $data = $this->getEmployeeList($params,$project_code); 
        if(isset($data))
        {
            return $this->response->setJsonContent($data);
        }
        else
        {
            return $this->sendForbidden();
        }      
    }
   

    public function getEmployeeList($params, $project_code)
    {       
        $builder = new Builder($params);
        $builder->columns([
            //"Employee.*,Employeeproject.*,Employeeprojectrelation.*"
            "Project.project_code, Project.project_name,Project.project_lead,Project.project_technology,Project.start_date,Project.end_date,Employee.id,Employee.employee_code,Employee.user_name,Employeeprojectrelation.id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
        
        $builder->Join("Project","Employee.id =Project.project_lead");
        $builder->Join("Employeeprojectrelation", "Employeeprojectrelation.employee_id = Project.project_lead");//->where("Employee.id = Project.project_lead")
       
        if(isset($project_code) && is_numeric($project_code) && $project_code > 0) 
        {
            $builder->where("Project.project_code = ".$project_code);
        }  
        else
        {
            echo "improper id please enter any integer type id";
        }

        $data = $builder->getQuery()->execute()->toArray();
        return $data;
    }
   
     /**
     * @SWG\Put(path="/allocation/{id}",
     *   tags={"EmployeeProjectRelation"},
     *   summary="Update an existing employee project details",
     *   description="Update existing employee project details",
     *   operationId="Update Relation Detials",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *    @SWG\Parameter(
     *     description="ID of Employee Project Relation",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Update Employee Project Relation details",
     *     required=false,
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="successful operation",
     *   ),
     *   @SWG\Response(
     *         response="400",
     *         description="Invalid data supplied",
     *   ),
     *   @SWG\Response(
     *         response="403",
     *         description="Not Authorized Invalid or missing Authorization header",
     *   ),
     *   @SWG\Response(
     *         response="404",
     *         description="ID Not Found",
     *   ),
     *   @SWG\Response(
     *         response="500",
     *         description="unexpected error",
     *   )
     * )
     */
    public function updateAllocationAction($id)
    {   
        $data =$this->request->getJsonRawBody();
       
        $relation = Employeeprojectrelation::findFirst([
           "conditions" => "id =".$id,
        ]);
         $projectPercAlloted =  $data->work_alloted;

        if($projectPercAlloted <= 1 )
        {  
            return $this->response->setJsonContent("Error: you have to allocate minimun 1%");
        }
            
        if($projectPercAlloted >= 100)
        {  
            return $this->response->setJsonContent("Error:you can not allocate more than 100% at a time");
        }    
         
        else
        {   
        
            $relation->work_alloted += $projectPercAlloted;  
            $relation->updated_date = date('Y-m-d H:i:s');

            if($relation->work_alloted  >= 100)
            { 
                return $this->response->setJsonContent("Error:your sum of work exceeding more than 100");
            }

            if (!$relation->update()) 
            {
                return $this->response->setStatusCode(400);
                return $this->response->setJsonContent("Data not updated");
            }
            else
            {  
                return $this->response->setJsonContent($relation);
            }
        }
    }

}   
