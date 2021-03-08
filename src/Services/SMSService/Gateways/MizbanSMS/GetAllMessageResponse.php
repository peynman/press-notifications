<?php

class GetAllMessageResponse
{

    /**
     * @var GetAllMessageResult $GetAllMessageResult
     * @access public
     */
    public $GetAllMessageResult = null;

    /**
     * @param GetAllMessageResult $GetAllMessageResult
     * @access public
     */
    public function __construct($GetAllMessageResult)
    {
        $this->GetAllMessageResult = $GetAllMessageResult;
    }
}
