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
     * @SWG\Get(
     *     tags={"EmployeeProjectRelation"},
     *     path="/Employeeprojectrelation/{id}",
     *     description="Returns a Relation of Employee's Project based on a single ID",
     *     summary="Get Employee Project Deatils",
     *     operationId="GetEmployee",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *   @SWG\Parameter(
     *     description="ID of Employee project",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
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
    public function findbyidrelationAction($id)
    {
        $employee = Employeeprojectrelation::findFirst($id);
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
     *     path="/Employeeprojectrelation/list/{id}",
     *     description="Returns all department from the system that the user has access to",
     *     summary="Get the employee project relation data",
     *     operationId="GetRelationData",
     *     produces={"application/json"},
     *   @SWG\Parameter(
     *     description="ID of Employee project",
     *     in="query",
     *     name="employee_id",
     *     required=false,
     *     type="integer",
     *     format="int64"
     *   ),
     @SWG\Parameter(
     *         name="project_id",
     *         in="query",
     *         description="Leave Request added for",
     *         required=false,
     *         type="integer",
     *         format="int32"
     *     ),
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
    public function listAction()
    {       $request = new Request();
            // $id=$this->dispatcher->get('id');
            $id =$this->request->getQuery('employee_id');
       
            // $id = $this->request->getParam('id');
            
            $params = [
                'models' => 'Employee'
            ];

            $data = $this->getList($params,$id);
            if(isset($data))
            {
                return $this->response->setJsonContent($data);
            }
            else
            {
                return $this->sendForbidden();
            }
        
    }
   

    public function getList($params, $id)
    {   
           

        //--for decent o/p -- 1 - e - n - p
        //SELECT employee.id,employee.employee_code,employee.user_name,employee_project.project_code, employee_project.project_name,employee_project.project_lead, employee_project.project_technology,employee_project_relation.id as relation_id,employee_project_relation.created_date, employee_project_relation.updated_date from employee JOIN employee_project ON employee.id = employee_project.project_lead JOIN employee_project_relation ON employee_project_relation.id = employee_project.project_lead WHERE employee.id = employee_project.project_lead AND employee_project_relation.id =1 
        // $data = Employee::find($id);
    
        $builder = new Builder($params);
        $builder->columns([
            //"Employee.*,Employeeproject.*,Employeeprojectrelation.*"
            "Employee.id,Employee.employee_code,Employee.user_name,Employeeproject.project_code, Employeeproject.project_name,Employeeproject.project_lead,Employeeproject.project_technology,Employeeprojectrelation.id as relation_id,Employeeprojectrelation.created_date, Employeeprojectrelation.updated_date"
        ]);

        $builder->Join("Employeeproject","Employeeproject.project_lead = Employee.id");
        $builder->Join("Employeeprojectrelation", "Employeeprojectrelation.id = Employeeproject.project_lead");
       if(isset($this->id)) {
            $builder->andWhere("Employeeprojectrelation.employee_id = ".$this->id);
        }   

          $data = $builder->getQuery()->execute()->toArray();
          return $data;
    
    }
 }   