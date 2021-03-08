<?php

class GetStateResponse
{

    /**
     * @var States[] $GetStateResult
     * @access public
     */
    public $GetStateResult = null;

    /**
     * @param States[] $GetStateResult
     * @access public
     */
    public function __construct($GetStateResult)
    {
        $this->GetStateResult = $GetStateResult;
    }
}
