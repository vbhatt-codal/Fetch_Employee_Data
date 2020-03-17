<?php 

/**
  * @SWG\Definition(definition="Project", type="object",
  *     @SWG\Property(property="project_code", type="integer"),
  *     @SWG\Property(property="project_name", type="string"),
  *     @SWG\Property(property="start_date", type="string"),
  *     @SWG\Property(property="end_date", type="string"),
  *     @SWG\Property(property="project_lead", type="integer"),
  *     @SWG\Property(property="project_technology", type="string"),
  *     @SWG\Property(property="update_date", type="string"),
  *     @SWG\Property(property="create_date", type="string"),
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
     *         @SWG\Schema(ref="#/definitions/Project")
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
        $project = Project::find([
            "conditions" => "is_deleted=0",
           //'is_deleted is NULL'
        ]);
        return $this->response->setJsonContent($project);
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
    public function findByIdAction($project_code)
    {
        $project = Project::findFirst($project_code);
        return $this->response->setJsonContent($project);
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

    	$project = new Project();

        $project->project_code = $data->project_code;
        $project->project_name = $data->project_name;
        $project->start_date = $data->start_date;
        $project->end_date = $data->end_date;
        $project->project_lead = $data->project_lead;
        $project->project_technology = $data->project_technology;
        $project->update_date = $data->update_date;
        $project->create_date = $data->create_date;
        $project->is_deleted = 0;

        if (!$project->save()) 
         {
            return $this->response->setJsonContent("record not inserted");
         }
        else
         {  
            // echo json_encode($employee);
            return $this->response->setJsonContent($project);
          
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

        $project = Project::findFirst($project_code);
        
        $project->project_name = $data->project_name;
        $project->start_date = $data->start_date;
        $project->end_date = $data->end_date;
        $project->project_lead = $data->project_lead;
        $project->project_technology = $data->project_technology;
        $project->create_date = $data->create_date;
        $project->update_date = $data->update_date;

        if (!$project->update()) 
         {
            return $this->response->setJsonContent("Data not updated");
         }
        else
         {  
            // echo json_encode($employee);
            return $this->response->setJsonContent($project);
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

        $project = Project::findFirst($project_code);

        if(!$project->delete())
        {
           return $this->response->setJsonContent("Data not deleted");
        }
        else
        {  
            // echo json_encode($employee);
           return $this->response->setJsonContent($project);
        } 

      }


 }     