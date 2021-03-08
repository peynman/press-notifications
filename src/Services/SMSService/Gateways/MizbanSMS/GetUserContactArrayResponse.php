<?php

class GetUserContactArrayResponse
{

    /**
     * @var ContactUser[] $GetUserContactArrayResult
     * @access public
     */
    public $GetUserContactArrayResult = null;

    /**
     * @param ContactUser[] $GetUserContactArrayResult
     * @access public
     */
    public function __construct($GetUserContactArrayResult)
    {
        $this->GetUserContactArrayResult = $GetUserContactArrayResult;
    }
}
