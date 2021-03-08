<?php

class SendMsgUser
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
     * @var string $status
     * @access public
     */
    public $status = null;

    /**
     * @param string $mobile
     * @param string $txt
     * @param string $from
     * @param string $date
     * @param string $status
     * @access public
     */
    public function __construct($mobile, $txt, $from, $date, $status)
    {
        $this->mobile = $mobile;
        $this->txt = $txt;
        $this->from = $from;
        $this->date = $date;
        $this->status = $status;
    }
}
