<?php

class NetworkCredential
{

    /**
     * @var string $UserName
     * @access public
     */
    public $UserName = null;

    /**
     * @var string $Password
     * @access public
     */
    public $Password = null;

    /**
     * @var SecureString $SecurePassword
     * @access public
     */
    public $SecurePassword = null;

    /**
     * @var string $Domain
     * @access public
     */
    public $Domain = null;

    /**
     * @param string $UserName
     * @param string $Password
     * @param SecureString $SecurePassword
     * @param string $Domain
     * @access public
     */
    public function __construct($UserName, $Password, $SecurePassword, $Domain)
    {
        $this->UserName = $UserName;
        $this->Password = $Password;
        $this->SecurePassword = $SecurePassword;
        $this->Domain = $Domain;
    }
}
