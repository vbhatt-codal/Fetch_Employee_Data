<?php


//namespace Learning\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class Employeeproject extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('employee_project');
        $this->hasMany('project_lead', 'Employee' , 'id');
    }

     public function getSource() {
        return 'employee_project';
    }
    

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */

    public $project_code;

    public $project_name;
    
    public $start_date;

    public $end_date;

    public $project_lead;
    
    public $project_technology;
    
    public $updated_date;
    
    public $created_date;
    

    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }
}
