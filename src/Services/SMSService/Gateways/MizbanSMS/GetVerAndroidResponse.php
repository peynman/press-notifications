<?php

class GetVerAndroidResponse
{

    /**
     * @var VerAndroid[] $GetVerAndroidResult
     * @access public
     */
    public $GetVerAndroidResult = null;

    /**
     * @param VerAndroid[] $GetVerAndroidResult
     * @access public
     */
    public function __construct($GetVerAndroidResult)
    {
        $this->GetVerAndroidResult = $GetVerAndroidResult;
    }
}
