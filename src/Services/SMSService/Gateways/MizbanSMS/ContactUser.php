<?php

class ContactUser
{

    /**
     * @var string $Contactname
     * @access public
     */
    public $Contactname = null;

    /**
     * @var string $ContactTels
     * @access public
     */
    public $ContactTels = null;

    /**
     * @param string $Contactname
     * @param string $ContactTels
     * @access public
     */
    public function __construct($Contactname, $ContactTels)
    {
        $this->Contactname = $Contactname;
        $this->ContactTels = $ContactTels;
    }
}
