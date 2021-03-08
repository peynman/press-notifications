<?php

class GetUserContactResult
{

    /**
     * @var string $any
     * @access public
     */
    public $any = null;

    /**
     * @param string $any
     * @access public
     */
    public function __construct($any)
    {
        $this->any = $any;
    }
}
