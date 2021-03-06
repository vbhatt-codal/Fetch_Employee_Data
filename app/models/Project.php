<?php
//namespace Learning\Models;
use \Phalcon\Mvc\Model;
use \Phalcon\Mvc\Model\Behavior\SoftDelete;
/**
 * @SWG\Definition(definition="Project", type="object")
 */
class Project extends \Phalcon\Mvc\Model
{  

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
     * @var integer
     * @Column(column="project_perc_alloted", type="integer", length=3, nullable=false)
     * @SWG\Property(property="project_perc_alloted", type="integer")
     */
    public $project_perc_alloted;
    
    /**
     *
     * @var string
     * @Column(column="alloted_description", type="text", nullable=false)
     * @SWG\Property(property="alloted_description", type="text")
     */
    public $alloted_description;
    

    /**
     *
     * @var timestamp
     * @Column(column="update_date", type="timestamp", nullable=false)
     * @SWG\Property(property="update_date", type="string")
     */
    public $update_date;
    /**
     *
     * @var integer
     * @Column(column="is_deleted", type="tiny integer", length=1, nullable=false)
      * @SWG\Property(property="is_deleted", type="integer")
     */
    public $is_deleted;
    /**
     *
     * @var timestamp
     * @Column(column="created_date", type="timestamp", nullable=false)
     * @SWG\Property(property="created_date", type="string")
     */
    public $create_date;



    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('project'); 
        $this->hasMany('project_lead', 'Employee' , 'id');
        $this->hasMany('project_lead', 'Employeeprojectrelation' , 'project_code', ['alias' => 'Employeeprojectrelation']);
        $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\SoftDelete([
            'field' => 'is_deleted',
            'value' => '1'
        ]));
    }


    public function beforeValidationOnCreate()
    {
        $this->created_date = date("Y-m-d H:i:s");
    } 
    

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'project';
    }
    

    
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
    */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }
    

 //    public function beforeValidationOnCreate()
 //    {
 //        $minPercAllotted = 1;
 //        $maxPercAlloted = 100;


 //    if ( $project_perc_alloted < $minPercentage) {
 //        echo "Error: less than {$minPercentage}%";
 //    } elseif ($ $project_perc_alloted > $maxPercentage) {
 //        echo "Error: more than {$maxPercentage}%";
 //    } else {
 //        echo "Total percentage is {$project_perc_alloted}%";
 //    }
 //    }
}
