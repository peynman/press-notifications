<?php

class sendsms2Response
{

    /**
     * @var Long[] $sendsms2Result
     * @access public
     */
    public $sendsms2Result = null;

    /**
     * @param Long[] $sendsms2Result
     * @access public
     */
    public function __construct($sendsms2Result)
    {
        $this->sendsms2Result = $sendsms2Result;
    }
}
