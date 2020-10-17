<?php

class smscounterResponse
{

    /**
     * @var string $smscounterResult
     * @access public
     */
    public $smscounterResult = null;

    /**
     * @param string $smscounterResult
     * @access public
     */
    public function __construct($smscounterResult)
    {
      $this->smscounterResult = $smscounterResult;
    }

}
