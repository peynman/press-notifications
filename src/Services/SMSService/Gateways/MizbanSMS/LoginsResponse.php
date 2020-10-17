<?php

class LoginsResponse
{

    /**
     * @var Long[] $LoginsResult
     * @access public
     */
    public $LoginsResult = null;

    /**
     * @param Long[] $LoginsResult
     * @access public
     */
    public function __construct($LoginsResult)
    {
      $this->LoginsResult = $LoginsResult;
    }

}
