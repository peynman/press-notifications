<?php

class GetCitiesResponse
{

    /**
     * @var Cities[] $GetCitiesResult
     * @access public
     */
    public $GetCitiesResult = null;

    /**
     * @param Cities[] $GetCitiesResult
     * @access public
     */
    public function __construct($GetCitiesResult)
    {
      $this->GetCitiesResult = $GetCitiesResult;
    }

}
