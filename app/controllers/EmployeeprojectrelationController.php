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
     *     path="/Employeeprojectrelation/indexRelation",
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
    public function indexRelationAction()
    {
        $relation = Employeeprojectrelation::find();
        return $this->response->setJsonContent($relation);
    }

     /**
     * @SWG\Post(path="/Employeeprojectrelation/createRelation",
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
    public function createRelationAction()
    {
        $data =$this->request->getJsonRawBody();
       
        $relation = new Employeeprojectrelation();
        $relation->id = $data->id;
        $relation->project_code = $data->project_code;
        $relation->employee_id = $data->employee_id;
        $relation->updated_date = $data->updated_date;
        $relation->created_date = $data->created_date;
        if (!$relation->create()) 
        {
             return $this->response->setJsonContent("Data Not Inserted.");
        }
        else
        {  
        // echo json_encode($employee);
             return $this->response->setJsonContent($relation);
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
        $relation->created_date = $data->created_date;
        $relation->updated_date = $data->updated_date;

        if (!$relation->update()) 
         {
            return $this->response->setJsonContent("Data not updated");
         }
        else
         {  
            // echo json_encode($employee);
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
            // echo json_encode($employee);
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
             "Employee.id, Employee.employee_code, Employee.user_name, Project.project_code, Project.project_name, Project.project_lead, Project.project_technology, Project.start_date, Project.end_date, Employeeprojectrelation.id as relation_id, Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
 
        //$builder->Where("Employee.id = Employeeprojectrelation.id AND Employee.id=Project.project_lead");
            $builder->Join("Project","Employee.id =Project.project_lead");
            $builder->Join("Employeeprojectrelation", "Employee.id =Employeeprojectrelation.employee_id");

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
            "Project.project_code, Project.project_name,Project.project_lead,Project.project_technology,Project.start_date,Project.end_date,Employee.id,Employee.employee_code,Employee.user_name,Employeeprojectrelation.id as relation_id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
         $builder->Join("Project","Employee.id =Project.project_lead");
        $builder->Join("Employeeprojectrelation", "Employeeprojectrelation.employee_id = Project.project_lead")->where("Employee.id = Project.project_lead");
       
       
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