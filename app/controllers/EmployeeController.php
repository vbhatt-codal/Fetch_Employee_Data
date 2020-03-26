<?php

/**
  * @SWG\Definition(definition="Employee", type="object",
  *     @SWG\Property(property="id", type="integer"),
  *     @SWG\Property(property="employee_code", type="string"),
  *     @SWG\Property(property="first_name", type="string"),
  *     @SWG\Property(property="last_name", type="string"),
  *     @SWG\Property(property="position", type="string"), 
  * )
 */

use Phalcon\Http\Response;
use Phlacon\Mvc\Model;

class EmployeeController extends ControllerBase
{

    /**
     * @SWG\Get(
     *     tags={"Employee"},
     *     path="/Employee/index",
     *     description="Returns a Employee details based on a single ID",
     *     summary="Get Employee Deatils",
     *     operationId="GetEmployee",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="Employee response",
     *         @SWG\Schema(ref="#/definitions/Employee")
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
        $employee = Employee::find([
            "columns" => "id,employee_code,first_name,last_name,position",
           "conditions" => "employee_deleted=0",
        ]);
        return $this->response->setJsonContent($employee);
    }

    /**
     * @SWG\Get(
     *     tags={"Employee"},
     *     path="/employee/{id}",
     *     description="Returns a Employee based on a single ID",
     *     summary="Get Employee Deatils by a particular ID",
     *     operationId="GetEmployeeById",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *   @SWG\Parameter(
     *     description="ID of Employee",
     *     in="path",
     *     name="id",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Project response",
     *          @SWG\Schema(ref="#/definitions/Employee")
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
    public function findByIdAction($id)
    {
        $employee = Employee::find([
          "conditions" => $id,
          "columns" => "id,employee_code,first_name,last_name,position",
          ]);
        return $this->response->setJsonContent($employee);
    }

  }  