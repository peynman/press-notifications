<?php

class GetCountSmsResponse
{

    /**
     * @var string $GetCountSmsResult
     * @access public
     */
    public $GetCountSmsResult = null;

    /**
     * @param string $GetCountSmsResult
     * @access public
     */
    public function __construct($GetCountSmsResult)
    {
      $this->GetCountSmsResult = $GetCountSmsResult;
    }

}
