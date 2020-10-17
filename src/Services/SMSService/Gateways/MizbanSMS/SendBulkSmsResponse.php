<?php

class SendBulkSmsResponse
{

    /**
     * @var string $SendBulkSmsResult
     * @access public
     */
    public $SendBulkSmsResult = null;

    /**
     * @param string $SendBulkSmsResult
     * @access public
     */
    public function __construct($SendBulkSmsResult)
    {
      $this->SendBulkSmsResult = $SendBulkSmsResult;
    }

}
