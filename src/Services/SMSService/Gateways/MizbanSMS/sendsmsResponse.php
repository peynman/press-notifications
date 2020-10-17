<?php

class sendsmsResponse
{

    /**
     * @var Long[] $sendsmsResult
     * @access public
     */
    public $sendsmsResult = null;

    /**
     * @param Long[] $sendsmsResult
     * @access public
     */
    public function __construct($sendsmsResult)
    {
      $this->sendsmsResult = $sendsmsResult;
    }

}
