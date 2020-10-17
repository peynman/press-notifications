<?php

class CreditesResponse
{

    /**
     * @var float $CreditesResult
     * @access public
     */
    public $CreditesResult = null;

    /**
     * @param float $CreditesResult
     * @access public
     */
    public function __construct($CreditesResult)
    {
      $this->CreditesResult = $CreditesResult;
    }

}
