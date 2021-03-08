<?php

class GeSMSNumberResponse
{

    /**
     * @var QuerySMSNumber[] $GeSMSNumberResult
     * @access public
     */
    public $GeSMSNumberResult = null;

    /**
     * @param QuerySMSNumber[] $GeSMSNumberResult
     * @access public
     */
    public function __construct($GeSMSNumberResult)
    {
        $this->GeSMSNumberResult = $GeSMSNumberResult;
    }
}
