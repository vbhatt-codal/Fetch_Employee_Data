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
     * @Column(column="user_name", type="string", length=20, nullable=false)
     * @SWG\Property(property="user_name", type="string")
     */
    public $user_name;

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
     * @Column(column="email", type="string", length=100, nullable=false)
     * @SWG\Property(property="email", type="string")
     */
    public $email;

    /**
     *
     * @var string
     * @Column(column="phone", type="string", length=20, nullable=true)
     * @SWG\Property(property="phone", type="string")
     */
    public $phone;

    /**
     *
     * @var string
     * @Column(column="date_of_birth", type="string", length=20, nullable=true)
     * @SWG\Property(property="date_of_birth", type="string")
     */
    public $date_of_birth;

    /**
     *
     * @var string
     * @Column(column="gender", type="string", length=10, nullable=false)
     * @SWG\Property(property="gender", type="string")
     */
    public $gender;

    /**
     *
     * @var string
     * @Column(column="position", type="string", length=20, nullable=false)
     * @SWG\Property(property="position", type="string")
     */
    public $position;

    /**
     *
     * @var string
     * @Column(column="hire_date", type="string", nullable=false)
     * @SWG\Property(property="hire_date", type="string")
     */
    public $hire_date;

    /**
     *
     * @var string
     * @Column(column="slack_username", type="string", nullable=false)
     * @SWG\Property(property="slack_username", type="string")
     */
    public $slack_username;

    /**
     *
     * @var string
     * @Column(column="git_username", type="string", nullable=false)
    * @SWG\Property(property="git_username", type="string")
     */
    public $git_username;

    /**
     *
     * @var string
     * @Column(column="leaving_date", type="string", nullable=false)
     * @SWG\Property(property="leaving_date", type="string")
     */
    public $leaving_date;
     
    /**
     *
     * @var integer
     * @Column(column="employee_deleted", type="integer", length=1, nullable=false)
     * @SWG\Property(property="is_deleted", type="integer")
     */
    public $employee_deleted;

    /**
     *
     * @var string
     * @Column(column="created", type="string", nullable=false)
     * @SWG\Property(property="created", type="string")
     */
    public $created;

    /**
     *
     * @var string
     * @Column(column="updated", type="string", nullable=false)
     * @SWG\Property(property="updated", type="string")
     */
    public $updated;
    /**
     *
     * @var integer
     * @Column(column="attendance_notification", type="integer", length=1, nullable=false)
     * @SWG\Property(property="attendance_notification", type="integer")
     */
    public $attendance_notification;
    /**
     *
     * @var integer
     * @Column(column="slack_notification", type="integer", length=1, nullable=false)
     * @SWG\Property(property="slack_notification", type="integer")
     */
    public $slack_notification;
    /**
     *
     * @var string
     * @Column(column="slack_profile", type="string", length=50, nullable=false)
     * @SWG\Property(property="slack_profile", type="string")
     */
    public $slack_profile;
    /**
     * Validations and business logic
     *
     * @return boolean
     */

    /**
     *
     * @var string
     * @Column(column="profile_image", type="string")
     * @SWG\Property(property="profile_image", type="string")
     */
    public $profile_image;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("employee");
        $this->hasMany('id', 'RelatedTags', 'entity_id');
        $this->hasMany('id', 'Employeeprojectrelation' , 'employee_id', ["alias" => "Employeeprojectrelation"]);
        $this->hasOne('id', 'EmployeeMeta', 'employee_id', ['alias' => 'EmployeeMetaData']);
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
