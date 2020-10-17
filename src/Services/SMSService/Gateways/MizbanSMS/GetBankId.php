<?php

class GetBankId
{

    /**
     * @var int $bankId
     * @access public
     */
    public $bankId = null;

    /**
     * @param int $bankId
     * @access public
     */
    public function __construct($bankId)
    {
      $this->bankId = $bankId;
    }

}
