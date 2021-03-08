<?php

class DelsendsmsfutureResponse
{

    /**
     * @var Long[] $DelsendsmsfutureResult
     * @access public
     */
    public $DelsendsmsfutureResult = null;

    /**
     * @param Long[] $DelsendsmsfutureResult
     * @access public
     */
    public function __construct($DelsendsmsfutureResult)
    {
        $this->DelsendsmsfutureResult = $DelsendsmsfutureResult;
    }
}
