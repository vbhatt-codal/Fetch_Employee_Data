<?php

/**
 * @SWG\Definition(definition="Employee", type="object")
 */
use \Phalcon\Mvc\Model;
use Phalcon\Validation;
use \Phalcon\Mvc\Model\Behavior\SoftDelete;

//use Phalcon\Validation\Validator\PresenceOf;

class Employee extends \Phalcon\Mvc\Model
{
   // use JsonModelTrait;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(column="employee_code", type="string", length=10, nullable=false)
     * @SWG\Property(property="employee_code", type="string")
     */
    public $employee_code;


    /**
     *
     * @var string
     * @Column(column="first_name", type="string", length=20, nullable=false)
     * @SWG\Property(property="first_name", type="string")
     */
    public $first_name;

    /**
     *
     * @var string
     * @Column(column="last_name", type="string", length=20, nullable=false)
     * @SWG\Property(property="last_name", type="string")
     */
    public $last_name;

    
    /**
     *
     * @var string
     * @Column(column="position", type="string", length=20, nullable=false)
     * @SWG\Property(property="position", type="string")
     */
    public $position;

    

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("employee");
        $this->hasMany(
                'id', 
                'Employeeprojectrelation', 
                'employee_id', 
                ["alias" => "Employeeprojectrelation"]
        );
       
        $this->hasManyToMany(
            "id",
            "Employeeprojectrelation",
            "employee_id", "project_code",
            "Project",
            "id"
        );
        $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\SoftDelete([
            'field' => 'employee_deleted',
            'value' => '1'
        ]));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'employee';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Employee[]|Employee|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Employee|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    // public function getEmployeeDetails($column,$condition)
    // {
    //     return  Employee::findFirst([
    //               "columns" => $column,
    //               "conditions" => $condition
    //             ]);
    // }
}
