<?php

class GetCities
{

    /**
     * @var string $parent
     * @access public
     */
    public $parent = null;

    /**
     * @param string $parent
     * @access public
     */
    public function __construct($parent)
    {
        $this->parent = $parent;
    }
}
