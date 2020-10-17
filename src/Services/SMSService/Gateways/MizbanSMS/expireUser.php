<?php

class expireUser
{

    /**
     * @var string $startdate
     * @access public
     */
    public $startdate = null;

    /**
     * @var string $enddate
     * @access public
     */
    public $enddate = null;

    /**
     * @param string $startdate
     * @param string $enddate
     * @access public
     */
    public function __construct($startdate, $enddate)
    {
      $this->startdate = $startdate;
      $this->enddate = $enddate;
    }

}
