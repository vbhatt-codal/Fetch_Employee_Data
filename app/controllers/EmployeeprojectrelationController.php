<?php

use Phlacon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;
use Phalcon\Http\Request;
/**
  * @SWG\Definition(definition="Employeeprojectrelation", type="object",
  *     @SWG\Property(property="id", type="integer"),
  *     @SWG\Property(property="project_code", type="integer"),
  *     @SWG\Property(property="employee_id", type="integer"),
  *     @SWG\Property(property="updated_date", type="string"),
  *     @SWG\Property(property="created_date", type="string"),
  * )
 */

class EmployeeprojectrelationController extends ControllerBase
{
    // use MysqlControllerTrait;
     protected $id;
     protected $project_code;
    /**
     * @SWG\Get(
     *     tags={"EmployeeProjectRelation"},
     *     path="/Employeeprojectrelation/indexrelation",
     *     description="Returns a Relation between employee and project based on a single ID",
     *     summary="Get Employee Project Deatils",
     *     operationId="GetEmployee",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="department response",
               @SWG\Schema(ref="#/definitions/Employeeprojectrelation")
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
    public function indexrelationAction()
    {
        $employee = Employeeprojectrelation::find();
        return $this->response->setJsonContent($employee);
    }

     /**
     * @SWG\Post(path="/Employeeprojectrelation/createrelation",
     *   tags={"EmployeeProjectRelation"},
     *   summary="Create a new Employee Project",
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
    public function createrelationAction()
    {
        $data =$this->request->getJsonRawBody();
       
        $employee = new Employeeprojectrelation();
        $employee->id = $data->id;
        $employee->project_code = $data->project_code;
        $employee->employee_id = $data->employee_id;
        $employee->updated_date = $data->updated_date;
        $employee->created_date = $data->created_date;
        if (!$employee->create()) 
        {
             return $this->response->setJsonContent("Data Not Inserted.");
        }
        else
        {  
        // echo json_encode($employee);
             return $this->response->setJsonContent($employee);
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

        $employee = Employeeprojectrelation::findFirst($id);
        
        $employee->project_code = $data->project_code;
        $employee->employee_id = $data->employee_id;
        $employee->created_date = $data->created_date;
        $employee->updated_date = $data->updated_date;

        if (!$employee->update()) 
         {
            return $this->response->setJsonContent("Data not updated");
         }
        else
         {  
            // echo json_encode($employee);
            return $this->response->setJsonContent($employee);
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
        $employee = Employeeprojectrelation::findFirst($id);
        if(!$employee->delete())
        {
           return $this->response->setJsonContent("Data not deleted");
        }
        else
        {  
            // echo json_encode($employee);
           return $this->response->setJsonContent($employee);
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
    public function getprojectbyemployeeAction($id)
    {             
       
            $request = new Request();
            
            $params = [
                'models' => 'Employee'
            ];

            $data = $this->getprojectList($params,$id); 
            if(isset($data))
            {
                return $this->response->setJsonContent($data);
            }
            else
            {
                return $this->sendForbidden();
            }
        
    }
   

    public function getprojectList($params, $id)
    {       
         
        $builder = new Builder($params);
        $builder->columns([
           // "Employee.*,Project.*,Employeeprojectrelation.*"
             "Employee.id,Employee.employee_code,Employee.user_name,Project.project_code, Project.project_name,Project.project_lead,Project.project_technology,Employeeprojectrelation.id as relation_id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
        $builder->Join("Project","Employee.id =Project.project_lead");
        $builder->Join("Employeeprojectrelation", "Project.project_lead =Employeeprojectrelation.id")->where('Employee.id = Project.project_lead');
        

        if(isset($id))
        {
            $builder->where("Employee.id = ".$id);
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
    public function getemployeebyprojectAction($project_code)
    {             
            $request = new Request();
    
            $params = [
                'models' => 'Employee'
            ];

            $data = $this->getemployeeList($params,$project_code); 
            if(isset($data))
            {
                return $this->response->setJsonContent($data);
            }
            else
            {
                return $this->sendForbidden();
            }      
    }
   

    public function getemployeeList($params, $project_code)
    {       
        $builder = new Builder($params);
        $builder->columns([
            //"Employee.*,Employeeproject.*,Employeeprojectrelation.*"
            "Project.project_code, Project.project_name,Project.project_lead,Project.project_technology,Employee.id,Employee.employee_code,Employee.user_name,Employeeprojectrelation.id as relation_id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
         $builder->Join("Project","Employee.id =Project.project_lead");
        $builder->Join("Employeeprojectrelation", "Employeeprojectrelation.id = Project.project_lead")->where("Employee.id = Project.project_lead");
       
       
        if(isset($project_code)) 
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

    
 }   