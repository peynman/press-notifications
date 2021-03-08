<?php

class GetUserNumberArrayResponse
{

    /**
     * @var SeUser[] $GetUserNumberArrayResult
     * @access public
     */
    public $GetUserNumberArrayResult = null;

    /**
     * @param SeUser[] $GetUserNumberArrayResult
     * @access public
     */
    public function __construct($GetUserNumberArrayResult)
    {
        $this->GetUserNumberArrayResult = $GetUserNumberArrayResult;
    }
}
