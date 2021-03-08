<?php

class GetBankIdResponse
{

    /**
     * @var string $GetBankIdResult
     * @access public
     */
    public $GetBankIdResult = null;

    /**
     * @param string $GetBankIdResult
     * @access public
     */
    public function __construct($GetBankIdResult)
    {
        $this->GetBankIdResult = $GetBankIdResult;
    }
}
