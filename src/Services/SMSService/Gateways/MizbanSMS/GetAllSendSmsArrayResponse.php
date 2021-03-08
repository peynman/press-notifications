<?php

class GetAllSendSmsArrayResponse
{

    /**
     * @var SendMsgUser[] $GetAllSendSmsArrayResult
     * @access public
     */
    public $GetAllSendSmsArrayResult = null;

    /**
     * @param SendMsgUser[] $GetAllSendSmsArrayResult
     * @access public
     */
    public function __construct($GetAllSendSmsArrayResult)
    {
        $this->GetAllSendSmsArrayResult = $GetAllSendSmsArrayResult;
    }
}
