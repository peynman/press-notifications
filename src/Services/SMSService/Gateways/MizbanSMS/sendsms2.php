<?php

class sendsms2
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
     * @var string $to
     * @access public
     */
    public $to = null;

    /**
     * @var string $text
     * @access public
     */
    public $text = null;

    /**
     * @var string $from
     * @access public
     */
    public $from = null;

    /**
     * @param string $username
     * @param string $password
     * @param string $to
     * @param string $text
     * @param string $from
     * @access public
     */
    public function __construct($username, $password, $to, $text, $from)
    {
      $this->username = $username;
      $this->password = $password;
      $this->to = $to;
      $this->text = $text;
      $this->from = $from;
    }

}
