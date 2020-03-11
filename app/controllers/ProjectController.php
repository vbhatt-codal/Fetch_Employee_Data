<?php 

/**
  * @SWG\Definition(definition="Project", type="object",
  *     @SWG\Property(property="project_code", type="string"),
  *     @SWG\Property(property="project_name", type="string"),
  *     @SWG\Property(property="start_date", type="string"),
  *     @SWG\Property(property="end_date", type="string"),
  *     @SWG\Property(property="project_lead", type="string"),
  *     @SWG\Property(property="project_technology", type="string"),
  *     @SWG\Property(property="updated_date", type="string"),
  *     @SWG\Property(property="created_date", type="string"),
  * )
 */
use Phlacon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;


class ProjectController extends ControllerBase
{

    /**
     * @SWG\Get(
     *     tags={"Project"},
     *     path="/Project/index",
     *     description="Returns a Projects details based on a single ID",
     *     summary="Get Project Deatils",
     *     operationId="GetEmployee",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="department response",
               @SWG\Schema(ref="#/definitions/Project")
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
    public function indexAction()
    {
        $employee = Project::find([
            "conditions" => "is_deleted=0",
           //'is_deleted is NULL'
        ]);
        return $this->response->setJsonContent($employee);
    }

    /**
     * @SWG\Get(
     *     tags={"Project"},
     *     path="/project/{id}",
     *     description="Returns a Project based on a single ID",
     *     summary="Get Project Deatils",
     *     operationId="GetEmployee",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *   @SWG\Parameter(
     *     description="ID of project",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Project response",
     *          @SWG\Schema(ref="#/definitions/Project")
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
    public function findbyidAction($project_code)
    {
        $employee = Project::findFirst($project_code);
        return $this->response->setJsonContent($employee);
    }

     /**
     * @SWG\Post(path="/Project/save",
     *   tags={"Project"},
     *   summary="Create a new  Project",
     *   description="create new project",
     *   summary="Add Project Details",
     *   operationId="CreateEmployee",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="insert record",
     *     required=false,
     *     @SWG\Schema(ref="#/definitions/Project")
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
    public function saveAction()
    {
        $data =$this->request->getJsonRawBody();
        // print_r($data->project_code);die;
    	$employee = new Project();

        // var_dump($employee);exit;
        $employee->project_code = $data->project_code;
        $employee->project_name = $data->project_name;
        $employee->start_date = $data->start_date;
        $employee->end_date = $data->end_date;
        $employee->project_lead = $data->project_lead;
        $employee->project_technology = $data->project_technology;
        $employee->update_date = $data->updated_date;
        $employee->create_date = $data->created_date;
        $employee->is_deleted = 0;
         // print_r($employee);exit;
         if (!$employee->save()) 
         {
            return $this->response->setJsonContent("record not inserted");
         }
        else
         {  
            // echo json_encode($employee);
            return $this->response->setJsonContent($employee);
          
         }
     
    }
    

    /**
     * @SWG\Put(path="/Project/{id}",
     *   tags={"Project"},
     *   summary="Update an existing  project details",
     *   description="Update existing  project details",
     *   operationId="UpdateEmployee",
     *   consumes={"application/json"},
     *   produces={"application/json"},
      *    @SWG\Parameter(
     *     description="ID of Employee project",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Update project details",
     *     required=false,
     *     @SWG\Schema(ref="#/definitions/Project")
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

    public function updateAction($project_code)
    {
        $data =$this->request->getJsonRawBody();

        $employee = Project::findFirst($project_code);
        
        $employee->project_name = $data->project_name;
        $employee->start_date = $data->start_date;
        $employee->end_date = $data->end_date;
        $employee->project_lead = $data->project_lead;
        $employee->project_technology = $data->project_technology;
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
     *     tags={"Project"},
     *     path="/Project/{id}",
     *     description="deletes a single  project record based on the ID",
     *     summary="delete Project data",
     *     operationId="DeleteEmployee",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of Project data to delete",
     *         format="int64",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="Project Record deleted",
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
    public function deleteAction($project_code)
      {

        $employee = Project::findFirst($project_code);

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


 }     