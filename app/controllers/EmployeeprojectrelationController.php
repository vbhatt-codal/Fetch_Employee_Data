<?php

use Phlacon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;
use Phalcon\Http\Request;
/**
  * @SWG\Definition(definition="Employeeprojectrelation", type="object",
  *     @SWG\Property(property="id", type="string"),
  *     @SWG\Property(property="project_code", type="string"),
  *     @SWG\Property(property="employee_id", type="string"),
  *     @SWG\Property(property="updated_date", type="string"),
  *     @SWG\Property(property="created_date", type="string"),
  * )
 */

class EmployeeprojectrelationController extends ControllerBase
{
    use MysqlControllerTrait;
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
        // print_r($data->project_code);die;
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

            $data = $this->getprojectList($params,$id); //getProject
            //$data = $this->getEmployeeList($params,$id);
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
            //"Employee.*,Employeeproject.*,Employeeprojectrelation.*"
            "Employee.id,Employee.employee_code,Employee.user_name,Employeeproject.project_code, Employeeproject.project_name,Employeeproject.project_lead,Employeeproject.project_technology,Employeeprojectrelation.id as relation_id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
        ]);
        $builder->Join("Employeeprojectrelation", "Employee.id = Employeeprojectrelation.employee_id");

        $builder->Join("Employeeproject","Employeeprojectrelation.project_code =Employeeproject.project_code");
       
       if(isset($id)) {
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
        // echo $id;exit;
            $request = new Request();
           
            
            $params = [
                'models' => 'Employee'
            ];

            $data = $this->getemployeeList($params,$project_code); //getProject
            //$data = $this->getEmployeeList($params,$id);
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
            "Employeeproject.project_code, Employeeproject.project_name,Employeeproject.project_lead,Employeeproject.project_technology,Employee.id,Employee.employee_code,Employee.user_name,Employeeprojectrelation.id as relation_id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
         ]);
         $builder->Join("Employeeproject","Employee.id =Employeeproject.project_lead");
        $builder->Join("Employeeprojectrelation", "Employeeprojectrelation.id = Employeeproject.project_lead")->where("Employee.id = Employeeprojectrelation.id");
       
       
       if(isset($project_code)) {
            $builder->where("Employeeproject.project_code = ".$project_code);
        }  
         else
         {
            echo "improper id please enter any integer type id";
         }

          $data = $builder->getQuery()->execute()->toArray();
          return $data;
    
    }


    
 }   