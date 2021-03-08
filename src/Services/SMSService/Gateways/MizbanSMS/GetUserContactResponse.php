<?php

class GetUserContactResponse
{

    /**
     * @var GetUserContactResult $GetUserContactResult
     * @access public
     */
    public $GetUserContactResult = null;

    /**
     * @param GetUserContactResult $GetUserContactResult
     * @access public
     */
    public function __construct($GetUserContactResult)
    {
        $this->GetUserContactResult = $GetUserContactResult;
    }
}
