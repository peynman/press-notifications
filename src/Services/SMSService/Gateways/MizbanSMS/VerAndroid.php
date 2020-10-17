<?php

class VerAndroid
{

    /**
     * @var string $value
     * @access public
     */
    public $value = null;

    /**
     * @var string $text
     * @access public
     */
    public $text = null;

    /**
     * @param string $value
     * @param string $text
     * @access public
     */
    public function __construct($value, $text)
    {
      $this->value = $value;
      $this->text = $text;
    }

}
