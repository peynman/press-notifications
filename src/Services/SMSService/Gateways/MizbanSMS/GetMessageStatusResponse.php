<?php

class GetMessageStatusResponse
{

    /**
     * @var int $GetMessageStatusResult
     * @access public
     */
    public $GetMessageStatusResult = null;

    /**
     * @param int $GetMessageStatusResult
     * @access public
     */
    public function __construct($GetMessageStatusResult)
    {
        $this->GetMessageStatusResult = $GetMessageStatusResult;
    }
}
