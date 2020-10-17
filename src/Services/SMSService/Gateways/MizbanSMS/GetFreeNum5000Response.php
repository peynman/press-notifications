<?php

class GetFreeNum5000Response
{

    /**
     * @var QueryNum5000[] $GetFreeNum5000Result
     * @access public
     */
    public $GetFreeNum5000Result = null;

    /**
     * @param QueryNum5000[] $GetFreeNum5000Result
     * @access public
     */
    public function __construct($GetFreeNum5000Result)
    {
      $this->GetFreeNum5000Result = $GetFreeNum5000Result;
    }

}
