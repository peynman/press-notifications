<?php

class GetAllMessageArrayResponse
{

    /**
     * @var RecMsgUser[] $GetAllMessageArrayResult
     * @access public
     */
    public $GetAllMessageArrayResult = null;

    /**
     * @param RecMsgUser[] $GetAllMessageArrayResult
     * @access public
     */
    public function __construct($GetAllMessageArrayResult)
    {
        $this->GetAllMessageArrayResult = $GetAllMessageArrayResult;
    }
}
