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
        $this->belongsTo("project_code", "Project", "project_lead", ['alias' => 'Employeeproject']);
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
     * @var date
     * @Column(column="start_date", type="date", nullable=false)
     * @SWG\Property(property="start_date", type="date")
     */
    public $start_date;

    /**
     *
     * @var date
     * @Column(column="end_date", type="date", nullable=false)
     * @SWG\Property(property="end_date", type="date")
     */
    public $end_date;
        
    /**
     *
     * @var integer
     * @Column(column="work_alloted", type="integer", nullable=false)
     * @SWG\Property(property="work_alloted", type="integer")
     */
    public $work_alloted;

    /**
     *
     * @var text
     * @Column(column="work_alloted_description", type="text", nullable=false)
     * @SWG\Property(property="work_alloted_description", type="text")
     */
    public $work_alloted_description;

    /**
     *
     * @var timestamp
     * @Column(column="update_date", type="timestamp", nullable=false)
     * @SWG\Property(property="update_date", type="string")
     */
    public $update_date;
    
    /**
     *
     * @var timestamp
     * @Column(column="created_date", type="timestamp", nullable=false)
     * @SWG\Property(property="create_date", type="string")
     */
    public $create_date;
    
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
