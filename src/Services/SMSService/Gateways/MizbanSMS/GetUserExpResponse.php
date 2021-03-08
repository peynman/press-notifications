<?php

class GetUserExpResponse
{

    /**
     * @var ExpireUser[] $GetUserExpResult
     * @access public
     */
    public $GetUserExpResult = null;

    /**
     * @param ExpireUser[] $GetUserExpResult
     * @access public
     */
    public function __construct($GetUserExpResult)
    {
        $this->GetUserExpResult = $GetUserExpResult;
    }
}
