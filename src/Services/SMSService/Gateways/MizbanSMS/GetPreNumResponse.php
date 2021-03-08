<?php

class GetPreNumResponse
{

    /**
     * @var String[] $GetPreNumResult
     * @access public
     */
    public $GetPreNumResult = null;

    /**
     * @param String[] $GetPreNumResult
     * @access public
     */
    public function __construct($GetPreNumResult)
    {
        $this->GetPreNumResult = $GetPreNumResult;
    }
}
