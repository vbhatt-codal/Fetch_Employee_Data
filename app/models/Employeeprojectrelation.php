<?php
use \Phalcon\Mvc\Model;
/**
 * @SWG\Definition(definition="Employeeprojectrelation", type="object")
 */
class Employeeprojectrelation extends \Phalcon\Mvc\Model
{  

     public function beforeValidationOnCreate()
    {
        $this->created_date = date("Y-m-d H:i:s");
    } 
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('employee_project_relation'); 
         $this->belongsTo("employee_id", "Employee", "id", ['alias' => 'Employee']);
        $this->belongsTo("project_code", "Employeeproject", "project_lead", ['alias' => 'Employeeproject']);
    }

    

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'employee_project_relation';
    }
    

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="project_code", type="integer", length=11, nullable=false)
      * @SWG\Property(property="project_code", type="integer")
     */
    public $project_code;

    /**
     *
     * @var integer
     * @Column(column="id", type="integer", length=11, nullable=false)
     * @SWG\Property(property="id", type="integer")
     */
    public $id;
    
    /**
     *
     * @var integer
     * @Column(column="employee_id", type="integer", length=11, nullable=false)
     * @SWG\Property(property="employee_id", type="integer")
     */
    public $employee_id;

    
    /**
     *
     * @var timestamp
     * @Column(column="update_date", type="timestamp", nullable=false)
     * @SWG\Property(property="update_date", type="string")
     */
    public $updated_date;
    
    /**
     *
     * @var timestamp
     * @Column(column="created_date", type="timestamp", nullable=false)
     * @SWG\Property(property="created_date", type="string")
     */
    public $created_date;
    
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
    */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }
}
