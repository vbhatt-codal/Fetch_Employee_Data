<?php

use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;
use Phalcon\Validation;
use Phalcon\Validation\Validator;

trait MysqlControllerTrait
{
	protected function extractData($data, $modelName='')
    {
        if(is_subclass_of($data, 'CallPotential\CPCommon\RestModel')) {
            return $data->formatJson();
        }
        if(!strlen($modelName)) {
            $modelName = $this->getModelName();
        }
        $model = new $modelName();
        $model->initialize();

        $result = array();
        foreach($data as $value)
        {
            if(is_array($value)) {
                $value = $model->formatJson($value);
            }
            elseif(is_subclass_of($value, 'CallPotential\CPCommon\RestModel' )) {
                return $value->formatJson();
            }
            $result[] = $value;
        }

        if ($this->id && !$this->relationship) $result = $result[0];

        return $result;
    }
 }   