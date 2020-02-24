<?php


//namespace Learning\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class Employee extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('employee');
    }

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;


    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */

    public $employee_code;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $user_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $email;

    public $phone;
    
    



    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }
}