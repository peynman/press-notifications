<?php

class Logins2Response
{

    /**
     * @var Long[] $Logins2Result
     * @access public
     */
    public $Logins2Result = null;

    /**
     * @param Long[] $Logins2Result
     * @access public
     */
    public function __construct($Logins2Result)
    {
      $this->Logins2Result = $Logins2Result;
    }

}
