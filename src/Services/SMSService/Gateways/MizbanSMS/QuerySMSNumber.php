<?php

class QuerySMSNumber
{

    /**
     * @var string $Name
     * @access public
     */
    public $Name = null;

    /**
     * @var string $number
     * @access public
     */
    public $number = null;

    /**
     * @var string $api
     * @access public
     */
    public $api = null;

    /**
     * @var string $enable
     * @access public
     */
    public $enable = null;

    /**
     * @param string $Name
     * @param string $number
     * @param string $api
     * @param string $enable
     * @access public
     */
    public function __construct($Name, $number, $api, $enable)
    {
        $this->Name = $Name;
        $this->number = $number;
        $this->api = $api;
        $this->enable = $enable;
    }
}
