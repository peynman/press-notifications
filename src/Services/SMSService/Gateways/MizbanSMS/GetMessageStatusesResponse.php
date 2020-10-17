<?php

class GetMessageStatusesResponse
{

    /**
     * @var Int[] $GetMessageStatusesResult
     * @access public
     */
    public $GetMessageStatusesResult = null;

    /**
     * @param Int[] $GetMessageStatusesResult
     * @access public
     */
    public function __construct($GetMessageStatusesResult)
    {
      $this->GetMessageStatusesResult = $GetMessageStatusesResult;
    }

}
