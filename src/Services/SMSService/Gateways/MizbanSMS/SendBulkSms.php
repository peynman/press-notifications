<?php

class SendBulkSms
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
     * @var string $api
     * @access public
     */
    public $api = null;

    /**
     * @var string $from
     * @access public
     */
    public $from = null;

    /**
     * @var int $bankId
     * @access public
     */
    public $bankId = null;

    /**
     * @var string $body
     * @access public
     */
    public $body = null;

    /**
     * @var string $recordEnd
     * @access public
     */
    public $recordEnd = null;

    /**
     * @var int $gender
     * @access public
     */
    public $gender = null;

    /**
     * @var int $receiverNumberKind
     * @access public
     */
    public $receiverNumberKind = null;

    /**
     * @var int $ageStart
     * @access public
     */
    public $ageStart = null;

    /**
     * @var int $ageEnd
     * @access public
     */
    public $ageEnd = null;

    /**
     * @var string $title
     * @access public
     */
    public $title = null;

    /**
     * @var int $receiverNumberPrefix
     * @access public
     */
    public $receiverNumberPrefix = null;

    /**
     * @var string $recordStart
     * @access public
     */
    public $recordStart = null;

    /**
     * @param string $username
     * @param string $password
     * @param string $api
     * @param string $from
     * @param int $bankId
     * @param string $body
     * @param string $recordEnd
     * @param int $gender
     * @param int $receiverNumberKind
     * @param int $ageStart
     * @param int $ageEnd
     * @param string $title
     * @param int $receiverNumberPrefix
     * @param string $recordStart
     * @access public
     */
    public function __construct($username, $password, $api, $from, $bankId, $body, $recordEnd, $gender, $receiverNumberKind, $ageStart, $ageEnd, $title, $receiverNumberPrefix, $recordStart)
    {
        $this->username = $username;
        $this->password = $password;
        $this->api = $api;
        $this->from = $from;
        $this->bankId = $bankId;
        $this->body = $body;
        $this->recordEnd = $recordEnd;
        $this->gender = $gender;
        $this->receiverNumberKind = $receiverNumberKind;
        $this->ageStart = $ageStart;
        $this->ageEnd = $ageEnd;
        $this->title = $title;
        $this->receiverNumberPrefix = $receiverNumberPrefix;
        $this->recordStart = $recordStart;
    }
}
