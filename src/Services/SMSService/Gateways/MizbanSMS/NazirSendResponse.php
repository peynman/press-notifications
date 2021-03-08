<?php

class NazirSendResponse
{

    /**
     * @var Long[] $NazirSendResult
     * @access public
     */
    public $NazirSendResult = null;

    /**
     * @param Long[] $NazirSendResult
     * @access public
     */
    public function __construct($NazirSendResult)
    {
        $this->NazirSendResult = $NazirSendResult;
    }
}
