<?php
//namespace Learning\Models;
use \Phalcon\Mvc\Model\Behavior\SoftDelete;
use \Phalcon\Mvc\Model\Validator\Email as Email;
/**
 * @SWG\Definition(definition="Employeeproject", type="object")
 */
class Employeeproject extends \Phalcon\Mvc\Model
{   
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('employee_project'); 
        $this->hasMany('project_lead', 'Employee' , 'id');
        $this->addBehavior(new SoftDelete([
            'field' => 'is_deleted',
            'value' => '1'
        ]));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'employee_project';
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
     * @var text
     * @Column(column="project_name", type="text", nullable=false)
     * @SWG\Property(property="project_name", type="string")
     */
    public $project_name;
    
    /**
     *
     * @var date
     * @Column(column="start_date", type="date", nullable=false)
     * @SWG\Property(property="start_date", type="string")
     */
    public $start_date;

    /**
     *
     * @var date
     * @Column(column="end_date", type="date", nullable=false)
     * @SWG\Property(property="end_date", type="string")
     */
    public $end_date;

    /**
     *
     * @var integer
     * @Column(column="project_lead", type="integer", length=5, nullable=false)
     * @SWG\Property(property="project_lead", type="integer")
     */
    public $project_lead;
    
    /**
     *
     * @var string
     * @Column(column="project_technology", type="string", length=10, nullable=false)
     * @SWG\Property(property="project_technology", type="string")
     */
    public $project_technology;
    
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
