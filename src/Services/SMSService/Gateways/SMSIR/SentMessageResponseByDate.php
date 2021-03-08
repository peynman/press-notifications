<?php

/**
 * @author Pejman Kheyri
 * @author Pejman Kheyri <pejmankheyri@gmail.com>
 * @copyright © 2018 The Ide Pardazan (ipe.ir) PHP Group. All rights reserved.
 * @link http://sms.ir/ Documentation of sms.ir RESTful API PHP sample.
 * @version 1.2
 */

class SmsIR_SentMessageResponseByDate
{
    
    /**
    * gets API Message Send Url.
    *
    * @return string Indicates the Url
    */
    protected function getAPIMessageSendUrl()
    {
        return "http://RestfulSms.com/api/MessageSend";
    }

    /**
    * gets Api Token Url.
    *
    * @return string Indicates the Url
    */
    protected function getApiTokenUrl()
    {
        return "http://RestfulSms.com/api/Token";
    }
    
    /**
    * gets config parameters for sending request.
    *
    * @param string $APIKey API Key
    * @param string $SecretKey Secret Key
    * @return void
    */
    public function __construct($APIKey, $SecretKey)
    {
        $this->APIKey = $APIKey;
        $this->SecretKey = $SecretKey;
    }

    /**
    * Gets Sent Message Response By Date.
    *
    * @param string $Shamsi_FromDate Shamsi From Date
    * @param string $Shamsi_ToDate Shamsi To Date
    * @param string $RowsPerPage Rows Per Page
    * @param string $RequestedPageNumber Requested Page Number
    * @return string Indicates the sent sms result
    */
    public function SentMessageResponseByDate($Shamsi_FromDate, $Shamsi_ToDate, $RowsPerPage, $RequestedPageNumber)
    {
        $token = $this->GetToken($this->APIKey, $this->SecretKey);
        if ($token != false) {
            $url = $this->getAPIMessageSendUrl()."?Shamsi_FromDate=".$Shamsi_FromDate."&Shamsi_ToDate=".$Shamsi_ToDate."&RowsPerPage=".$RowsPerPage."&RequestedPageNumber=".$RequestedPageNumber;
            $SentMessageResponseByDate = $this->execute($url, $token);
            
            $object = json_decode($SentMessageResponseByDate);

            if (is_object($object)) {
                $array = get_object_vars($object);
                if (is_array($array)) {
                    if ($array['IsSuccessful'] == true) {
                        $result = $array['Messages'];
                    } else {
                        $result = $array['Message'];
                    }
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }
    
    /**
    * gets token key for all web service requests.
    *
    * @return string Indicates the token key
    */
    private function GetToken()
    {
        $postData = array(
            'UserApiKey' => $this->APIKey,
            'SecretKey' => $this->SecretKey,
            'System' => 'php_rest_v_1_2'
        );
        $postString = json_encode($postData);

        $ch = curl_init($this->getApiTokenUrl());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json'
                                            ));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, count($postString));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($result);
        
        if (is_object($response)) {
            $resultVars = get_object_vars($response);
            if (is_array($resultVars)) {
                @$IsSuccessful = $resultVars['IsSuccessful'];
                if ($IsSuccessful == true) {
                    @$TokenKey = $resultVars['TokenKey'];
                    $resp = $TokenKey;
                } else {
                    $resp = false;
                }
            }
        }
        
        return $resp;
    }
    
    /**
    * executes the main method.
    *
    * @param string $url url
    * @param string $token token string
    * @return string Indicates the curl execute result
    */
    private function execute($url, $token)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json',
                                            'x-sms-ir-secure-token: '.$token
                                            ));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
}
