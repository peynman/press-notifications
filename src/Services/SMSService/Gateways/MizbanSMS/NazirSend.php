<?php

class NazirSend
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
     * @var string $tobank
     * @access public
     */
    public $tobank = null;

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
     * @var string $api
     * @access public
     */
    public $api = null;

    /**
     * @var int $year
     * @access public
     */
    public $year = null;

    /**
     * @var int $month
     * @access public
     */
    public $month = null;

    /**
     * @var int $day
     * @access public
     */
    public $day = null;

    /**
     * @var int $hour
     * @access public
     */
    public $hour = null;

    /**
     * @var int $min
     * @access public
     */
    public $min = null;

    /**
     * @param string $username
     * @param string $password
     * @param string $tobank
     * @param string $text
     * @param string $from
     * @param string $api
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $min
     * @access public
     */
    public function __construct($username, $password, $tobank, $text, $from, $api, $year, $month, $day, $hour, $min)
    {
        $this->username = $username;
        $this->password = $password;
        $this->tobank = $tobank;
        $this->text = $text;
        $this->from = $from;
        $this->api = $api;
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->hour = $hour;
        $this->min = $min;
    }
}
