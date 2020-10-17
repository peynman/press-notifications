<?php

class QueryPackage
{

    /**
     * @var string $Name
     * @access public
     */
    public $Name = null;

    /**
     * @var string $Price
     * @access public
     */
    public $Price = null;

    /**
     * @var string $MinSale
     * @access public
     */
    public $MinSale = null;

    /**
     * @var string $tariff
     * @access public
     */
    public $tariff = null;

    /**
     * @param string $Name
     * @param string $Price
     * @param string $MinSale
     * @param string $tariff
     * @access public
     */
    public function __construct($Name, $Price, $MinSale, $tariff)
    {
      $this->Name = $Name;
      $this->Price = $Price;
      $this->MinSale = $MinSale;
      $this->tariff = $tariff;
    }

}
