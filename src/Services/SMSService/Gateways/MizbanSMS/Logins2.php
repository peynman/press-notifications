<?php

class Logins2
{

    /**
     * @var string $user
     * @access public
     */
    public $user = null;

    /**
     * @var string $pass
     * @access public
     */
    public $pass = null;

    /**
     * @param string $user
     * @param string $pass
     * @access public
     */
    public function __construct($user, $pass)
    {
      $this->user = $user;
      $this->pass = $pass;
    }

}
