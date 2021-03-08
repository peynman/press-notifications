<?php

class GetFreeNumResponse
{

    /**
     * @var QueryNum[] $GetFreeNumResult
     * @access public
     */
    public $GetFreeNumResult = null;

    /**
     * @param QueryNum[] $GetFreeNumResult
     * @access public
     */
    public function __construct($GetFreeNumResult)
    {
        $this->GetFreeNumResult = $GetFreeNumResult;
    }
}
