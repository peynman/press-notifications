<?php

class GePackageResponse
{

    /**
     * @var QueryPackage[] $GePackageResult
     * @access public
     */
    public $GePackageResult = null;

    /**
     * @param QueryPackage[] $GePackageResult
     * @access public
     */
    public function __construct($GePackageResult)
    {
        $this->GePackageResult = $GePackageResult;
    }
}
