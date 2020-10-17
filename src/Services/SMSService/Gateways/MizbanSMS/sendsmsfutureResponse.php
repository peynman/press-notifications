<?php

class sendsmsfutureResponse
{

    /**
     * @var Long[] $sendsmsfutureResult
     * @access public
     */
    public $sendsmsfutureResult = null;

    /**
     * @param Long[] $sendsmsfutureResult
     * @access public
     */
    public function __construct($sendsmsfutureResult)
    {
      $this->sendsmsfutureResult = $sendsmsfutureResult;
    }

}
