<?php

class sendsmsSimCardResponse
{

    /**
     * @var Long[] $sendsmsSimCardResult
     * @access public
     */
    public $sendsmsSimCardResult = null;

    /**
     * @param Long[] $sendsmsSimCardResult
     * @access public
     */
    public function __construct($sendsmsSimCardResult)
    {
      $this->sendsmsSimCardResult = $sendsmsSimCardResult;
    }

}
