<?php

class QueryNum
{

    /**
     * @var boolean $open
     * @access public
     */
    public $open = null;

    /**
     * @var string $kind
     * @access public
     */
    public $kind = null;

    /**
     * @var int $status
     * @access public
     */
    public $status = null;

    /**
     * @param boolean $open
     * @param string $kind
     * @param int $status
     * @access public
     */
    public function __construct($open, $kind, $status)
    {
        $this->open = $open;
        $this->kind = $kind;
        $this->status = $status;
    }
}
