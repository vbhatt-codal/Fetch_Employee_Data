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
  *     @SWG\Property(property="start_date", type="string"),
  *     @SWG\Property(property="end_date", type="string"),
  *     @SWG\Property(property="work_alloted", type="integer"),
  *     @SWG\Property(property="work_alloted_description", type="string"),
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
                
             //   $workAlloted = $data['work_alloted'];   
            $projectPercAlloted =  $data->work_alloted;

            if($projectPercAlloted <= 1 )
            {
                return "Error: you have to allocate minimun 1%";
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
                $relation->employee_id = $data->employee_id;
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
        
            // Loop between timestamps, 24 hours at a time
            // for ( $i = $startDate; $i <= $endDate; $i = $i + 86400 ) {
            //   $thisDate = date( 'Y-m-d', $i ); // 2020-01-01, 2020-01-10, etc
            // }
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
        $projectPercAlloted =  $data->work_alloted;

        if($projectPercAlloted <= 1 )
        {
            return "Error: you have to allocate minimun 1%";
        }
            
        if($workAlloted >= 100)
        {
            return "Error:you can not allocate more than 100%";
        }    

        else
        {      
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
    public function updateAllocationAction($id)
    {   
        $data =$this->request->getJsonRawBody();
       
        $relation = Employeeprojectrelation::findFirst([
       
           "conditions" => "id =".$id,
        ]);
      
        //$relation += $data->work_alloted; 

            $relation->work_alloted += $data->work_alloted;
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

 }   





 /* public function projectAllocationAction($project_lead)
    {   
        $projectPercAlloted;
        $minPercentageAlloted =1;
        $maxPercentageAlloted =100;
        
        //SELECT SUM(project_perc_alloted) AS "Total working hours" FROM project WHERE project_lead =1 

            $params = [
                'models' => 'Project'
            ];

            $builder = new Builder($params);
            $builder->columns(['SUM(project_perc_alloted)'])
                    ->from('Project');
                if(isset($project_lead) && is_numeric($project_lead) && $project_lead > 0)
                {
                    $builder->where("project_lead = ".$project_lead);
                }  
                else
                {
                    echo "improper id please enter any integer type id";
                }


                $displayData = $builder->getQuery()->execute()->toArray();
               // return $this->response->setJsonContent($data);;
                

            $data = $this->request->getJsonRawBody();
            $projectCode = $data['project_code'];
            $projectName = $data['project_name'];
            $startDate = $date . ' ' . $data['start_date'];
            $endDate = $date . ' ' . $data['end_date'];
            $projectLead = $data['project_lead'];
            $projectPercAlloted = $data['project_perc_alloted'];
            $allotedDescription = $data['alloted_description'];



        //$percent = ($row['tally'] / $total) * 100;
            // while (strtotime($start_date) <= strtotime($end_date)) 
            // { // Compare start date is less than end date
                
            //         $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); // increment date by 1 day

            //         if ($project_perc_alloted < $minPercentage) {
            //             echo "Error: less than {$minPercentage}%";
            //         } 
            //         elseif ($project_perc_alloted > $maxPercentage) {
            //             echo "Error: more than {$maxPercentage}%";
            //         } 
            //         else {
            //             echo "Total percentage is {$project_perc_alloted}%";
            //         }
            // }
    
    }