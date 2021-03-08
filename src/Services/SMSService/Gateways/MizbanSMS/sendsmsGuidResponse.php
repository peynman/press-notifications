<?php

class sendsmsGuidResponse
{

    /**
     * @var Long[] $sendsmsGuidResult
     * @access public
     */
    public $sendsmsGuidResult = null;

    /**
     * @param Long[] $sendsmsGuidResult
     * @access public
     */
    public function __construct($sendsmsGuidResult)
    {
        $this->sendsmsGuidResult = $sendsmsGuidResult;
    }
}
