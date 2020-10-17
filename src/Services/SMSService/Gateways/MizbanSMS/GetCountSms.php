<?php

class GetCountSms
{

    /**
     * @var int $bankId
     * @access public
     */
    public $bankId = null;

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
     * @var int $receiverNumberPrefix
     * @access public
     */
    public $receiverNumberPrefix = null;

    /**
     * @param int $bankId
     * @param int $gender
     * @param int $receiverNumberKind
     * @param int $ageStart
     * @param int $ageEnd
     * @param int $receiverNumberPrefix
     * @access public
     */
    public function __construct($bankId, $gender, $receiverNumberKind, $ageStart, $ageEnd, $receiverNumberPrefix)
    {
      $this->bankId = $bankId;
      $this->gender = $gender;
      $this->receiverNumberKind = $receiverNumberKind;
      $this->ageStart = $ageStart;
      $this->ageEnd = $ageEnd;
      $this->receiverNumberPrefix = $receiverNumberPrefix;
    }

}
