<?php

class Delsendsmsfuture
{

    /**
     * @var string $username
     * @access public
     */
    public $username = null;

    /**
     * @var string $password
     * @access public
     */
    public $password = null;

    /**
     * @var string $Guid
     * @access public
     */
    public $Guid = null;

    /**
     * @param string $username
     * @param string $password
     * @param string $Guid
     * @access public
     */
    public function __construct($username, $password, $Guid)
    {
        $this->username = $username;
        $this->password = $password;
        $this->Guid = $Guid;
    }
}
