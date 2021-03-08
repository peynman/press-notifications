<?php

class Logins
{

    /**
     * @var NetworkCredential $secuity
     * @access public
     */
    public $secuity = null;

    /**
     * @param NetworkCredential $secuity
     * @access public
     */
    public function __construct($secuity)
    {
        $this->secuity = $secuity;
    }
}
