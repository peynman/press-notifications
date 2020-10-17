<?php

class GetAllMessage
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
     * @var int $countMsg
     * @access public
     */
    public $countMsg = null;

    /**
     * @param string $username
     * @param string $password
     * @param int $countMsg
     * @access public
     */
    public function __construct($username, $password, $countMsg)
    {
      $this->username = $username;
      $this->password = $password;
      $this->countMsg = $countMsg;
    }

}
