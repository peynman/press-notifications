<?php

class RecMsgUser
{

    /**
     * @var string $mobile
     * @access public
     */
    public $mobile = null;

    /**
     * @var string $txt
     * @access public
     */
    public $txt = null;

    /**
     * @var string $from
     * @access public
     */
    public $from = null;

    /**
     * @var string $date
     * @access public
     */
    public $date = null;

    /**
     * @param string $mobile
     * @param string $txt
     * @param string $from
     * @param string $date
     * @access public
     */
    public function __construct($mobile, $txt, $from, $date)
    {
        $this->mobile = $mobile;
        $this->txt = $txt;
        $this->from = $from;
        $this->date = $date;
    }
}
