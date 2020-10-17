<?php

class smscounter
{

    /**
     * @var string $text
     * @access public
     */
    public $text = null;

    /**
     * @param string $text
     * @access public
     */
    public function __construct($text)
    {
      $this->text = $text;
    }

}
