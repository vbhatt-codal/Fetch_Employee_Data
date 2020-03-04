<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{


	/**
     * @param array $data
     * @return array
     */
    protected function formatListResponse(array $data)
    {
        return $data;
    }
}
