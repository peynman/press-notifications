<?php

include_once('GeSMSNumber.php');
include_once('GeSMSNumberResponse.php');
include_once('QuerySMSNumber.php');
include_once('GetMessageStatus.php');
include_once('GetMessageStatusResponse.php');
include_once('GetMessageStatuses21.php');
include_once('GetMessageStatuses21Response.php');
include_once('GetMessageStatuses50004.php');
include_once('GetMessageStatuses50004Response.php');
include_once('GetMessageStatuses.php');
include_once('GetMessageStatusesResponse.php');
include_once('GetPreNum.php');
include_once('GetPreNumResponse.php');
include_once('GetPreNum5000.php');
include_once('GetPreNum5000Response.php');
include_once('GetFreeNum.php');
include_once('GetFreeNumResponse.php');
include_once('QueryNum.php');
include_once('GetFreeNum5000.php');
include_once('GetFreeNum5000Response.php');
include_once('QueryNum5000.php');
include_once('GePackage.php');
include_once('GePackageResponse.php');
include_once('QueryPackage.php');
include_once('sendsmsSimCard.php');
include_once('sendsmsSimCardResponse.php');
include_once('sendsms2.php');
include_once('sendsms2Response.php');
include_once('sendsms.php');
include_once('sendsmsResponse.php');
include_once('Delsendsmsfuture.php');
include_once('DelsendsmsfutureResponse.php');
include_once('sendsmsfuture.php');
include_once('sendsmsfutureResponse.php');
include_once('sendsmsfuture2.php');
include_once('sendsmsfuture2Response.php');
include_once('NazirSend.php');
include_once('NazirSendResponse.php');
include_once('smscounter.php');
include_once('smscounterResponse.php');
include_once('Credites.php');
include_once('CreditesResponse.php');
include_once('GetAllMessageArray.php');
include_once('GetAllMessageArrayResponse.php');
include_once('RecMsgUser.php');
include_once('GetBankId.php');
include_once('GetBankIdResponse.php');
include_once('GetCountSms.php');
include_once('GetCountSmsResponse.php');
include_once('SendBulkSms.php');
include_once('SendBulkSmsResponse.php');
include_once('GetAllMessage.php');
include_once('GetAllMessageResponse.php');
include_once('GetAllMessageResult.php');
include_once('GetUserExp.php');
include_once('GetUserExpResponse.php');
include_once('expireUser.php');
include_once('GetUserContact.php');
include_once('GetUserContactResponse.php');
include_once('GetUserContactResult.php');
include_once('GetUserContactArray.php');
include_once('GetUserContactArrayResponse.php');
include_once('ContactUser.php');
include_once('GetUserNumberArray.php');
include_once('GetUserNumberArrayResponse.php');
include_once('SeUser.php');
include_once('Logins2.php');
include_once('Logins2Response.php');
include_once('Logins.php');
include_once('NetworkCredential.php');
include_once('SecureString.php');
include_once('LoginsResponse.php');
include_once('GetState.php');
include_once('GetStateResponse.php');
include_once('States.php');
include_once('GetCities.php');
include_once('GetCitiesResponse.php');
include_once('Cities.php');
include_once('GetAllSendSmsArray.php');
include_once('GetAllSendSmsArrayResponse.php');
include_once('SendMsgUser.php');
include_once('GetVerAndroid.php');
include_once('GetVerAndroidResponse.php');
include_once('VerAndroid.php');
include_once('sendsmsGuid.php');
include_once('sendsmsGuidResponse.php');
include_once('DataTable.php');


/**
 * <b>وب سرويس خدمات پيام کوتاه.</b>
 */
class WSSMS extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     * @access private
     */
    private static $classmap = array(
      'GeSMSNumber' => '\GeSMSNumber',
      'GeSMSNumberResponse' => '\GeSMSNumberResponse',
      'QuerySMSNumber' => '\QuerySMSNumber',
      'GetMessageStatus' => '\GetMessageStatus',
      'GetMessageStatusResponse' => '\GetMessageStatusResponse',
      'GetMessageStatuses21' => '\GetMessageStatuses21',
      'GetMessageStatuses21Response' => '\GetMessageStatuses21Response',
      'GetMessageStatuses50004' => '\GetMessageStatuses50004',
      'GetMessageStatuses50004Response' => '\GetMessageStatuses50004Response',
      'GetMessageStatuses' => '\GetMessageStatuses',
      'GetMessageStatusesResponse' => '\GetMessageStatusesResponse',
      'GetPreNum' => '\GetPreNum',
      'GetPreNumResponse' => '\GetPreNumResponse',
      'GetPreNum5000' => '\GetPreNum5000',
      'GetPreNum5000Response' => '\GetPreNum5000Response',
      'GetFreeNum' => '\GetFreeNum',
      'GetFreeNumResponse' => '\GetFreeNumResponse',
      'QueryNum' => '\QueryNum',
      'GetFreeNum5000' => '\GetFreeNum5000',
      'GetFreeNum5000Response' => '\GetFreeNum5000Response',
      'QueryNum5000' => '\QueryNum5000',
      'GePackage' => '\GePackage',
      'GePackageResponse' => '\GePackageResponse',
      'QueryPackage' => '\QueryPackage',
      'sendsmsSimCard' => '\sendsmsSimCard',
      'sendsmsSimCardResponse' => '\sendsmsSimCardResponse',
      'sendsms2' => '\sendsms2',
      'sendsms2Response' => '\sendsms2Response',
      'sendsms' => '\sendsms',
      'sendsmsResponse' => '\sendsmsResponse',
      'Delsendsmsfuture' => '\Delsendsmsfuture',
      'DelsendsmsfutureResponse' => '\DelsendsmsfutureResponse',
      'sendsmsfuture' => '\sendsmsfuture',
      'sendsmsfutureResponse' => '\sendsmsfutureResponse',
      'sendsmsfuture2' => '\sendsmsfuture2',
      'sendsmsfuture2Response' => '\sendsmsfuture2Response',
      'NazirSend' => '\NazirSend',
      'NazirSendResponse' => '\NazirSendResponse',
      'smscounter' => '\smscounter',
      'smscounterResponse' => '\smscounterResponse',
      'Credites' => '\Credites',
      'CreditesResponse' => '\CreditesResponse',
      'GetAllMessageArray' => '\GetAllMessageArray',
      'GetAllMessageArrayResponse' => '\GetAllMessageArrayResponse',
      'RecMsgUser' => '\RecMsgUser',
      'GetBankId' => '\GetBankId',
      'GetBankIdResponse' => '\GetBankIdResponse',
      'GetCountSms' => '\GetCountSms',
      'GetCountSmsResponse' => '\GetCountSmsResponse',
      'SendBulkSms' => '\SendBulkSms',
      'SendBulkSmsResponse' => '\SendBulkSmsResponse',
      'GetAllMessage' => '\GetAllMessage',
      'GetAllMessageResponse' => '\GetAllMessageResponse',
      'GetAllMessageResult' => '\GetAllMessageResult',
      'GetUserExp' => '\GetUserExp',
      'GetUserExpResponse' => '\GetUserExpResponse',
      'expireUser' => '\expireUser',
      'GetUserContact' => '\GetUserContact',
      'GetUserContactResponse' => '\GetUserContactResponse',
      'GetUserContactResult' => '\GetUserContactResult',
      'GetUserContactArray' => '\GetUserContactArray',
      'GetUserContactArrayResponse' => '\GetUserContactArrayResponse',
      'ContactUser' => '\ContactUser',
      'GetUserNumberArray' => '\GetUserNumberArray',
      'GetUserNumberArrayResponse' => '\GetUserNumberArrayResponse',
      'SeUser' => '\SeUser',
      'Logins2' => '\Logins2',
      'Logins2Response' => '\Logins2Response',
      'Logins' => '\Logins',
      'NetworkCredential' => '\NetworkCredential',
      'SecureString' => '\SecureString',
      'LoginsResponse' => '\LoginsResponse',
      'GetState' => '\GetState',
      'GetStateResponse' => '\GetStateResponse',
      'States' => '\States',
      'GetCities' => '\GetCities',
      'GetCitiesResponse' => '\GetCitiesResponse',
      'Cities' => '\Cities',
      'GetAllSendSmsArray' => '\GetAllSendSmsArray',
      'GetAllSendSmsArrayResponse' => '\GetAllSendSmsArrayResponse',
      'SendMsgUser' => '\SendMsgUser',
      'GetVerAndroid' => '\GetVerAndroid',
      'GetVerAndroidResponse' => '\GetVerAndroidResponse',
      'VerAndroid' => '\VerAndroid',
      'sendsmsGuid' => '\sendsmsGuid',
      'sendsmsGuidResponse' => '\sendsmsGuidResponse',
      'DataTable' => '\DataTable');

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct(array $options = array(), $wsdl = 'http://my.mizbansms.ir/wssms.asmx?WSDL')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      
      parent::__construct($wsdl, $options);
    }

    /**
     * <b>متد استعلام  شماره اختصاصی کاربران.</b>
     *
     * @param GeSMSNumber $parameters
     * @access public
     * @return GeSMSNumberResponse
     */
    public function GeSMSNumber(GeSMSNumber $parameters)
    {
      return $this->__soapCall('GeSMSNumber', array($parameters));
    }

    /**
     * <b>3000متد استعلام  وضعيت پيامک.</b>
     *
     * @param GetMessageStatus $parameters
     * @access public
     * @return GetMessageStatusResponse
     */
    public function GetMessageStatus(GetMessageStatus $parameters)
    {
      return $this->__soapCall('GetMessageStatus', array($parameters));
    }

    /**
     * <b>021  متد استعلام  وضعيت پيامک ها.</b>
     *
     * @param GetMessageStatuses21 $parameters
     * @access public
     * @return GetMessageStatuses21Response
     */
    public function GetMessageStatuses21(GetMessageStatuses21 $parameters)
    {
      return $this->__soapCall('GetMessageStatuses21', array($parameters));
    }

    /**
     * <b>50004متد استعلام  وضعيت پيامک ها.</b>
     *
     * @param GetMessageStatuses50004 $parameters
     * @access public
     * @return GetMessageStatuses50004Response
     */
    public function GetMessageStatuses50004(GetMessageStatuses50004 $parameters)
    {
      return $this->__soapCall('GetMessageStatuses50004', array($parameters));
    }

    /**
     * <b>متد استعلام  وضعيت پيامک ها3000 .</b>
     *
     * @param GetMessageStatuses $parameters
     * @access public
     * @return GetMessageStatusesResponse
     */
    public function GetMessageStatuses(GetMessageStatuses $parameters)
    {
      return $this->__soapCall('GetMessageStatuses', array($parameters));
    }

    /**
     * <b>3000متد بازگشت پيش شماره اختصاصي.</b>
     *
     * @param GetPreNum $parameters
     * @access public
     * @return GetPreNumResponse
     */
    public function GetPreNum(GetPreNum $parameters)
    {
      return $this->__soapCall('GetPreNum', array($parameters));
    }

    /**
     * <b>5000متد بازگشت پيش شماره اختصاصي.</b>
     *
     * @param GetPreNum5000 $parameters
     * @access public
     * @return GetPreNum5000Response
     */
    public function GetPreNum5000(GetPreNum5000 $parameters)
    {
      return $this->__soapCall('GetPreNum5000', array($parameters));
    }

    /**
     * <b>متد استعلام  شماره اختصاصي3000.</b>
     *
     * @param GetFreeNum $parameters
     * @access public
     * @return GetFreeNumResponse
     */
    public function GetFreeNum(GetFreeNum $parameters)
    {
      return $this->__soapCall('GetFreeNum', array($parameters));
    }

    /**
     * <b>متد استعلام  شماره اختصاصي5000.</b>
     *
     * @param GetFreeNum5000 $parameters
     * @access public
     * @return GetFreeNum5000Response
     */
    public function GetFreeNum5000(GetFreeNum5000 $parameters)
    {
      return $this->__soapCall('GetFreeNum5000', array($parameters));
    }

    /**
     * <b>متد استعلام  پکيج کاربران.</b>
     *
     * @param GePackage $parameters
     * @access public
     * @return GePackageResponse
     */
    public function GePackage(GePackage $parameters)
    {
      return $this->__soapCall('GePackage', array($parameters));
    }

    /**
     * <b>متد ارسال اس ام اس سیم کارتی.</b>
     *
     * @param sendsmsSimCard $parameters
     * @access public
     * @return sendsmsSimCardResponse
     */
    public function sendsmsSimCard(sendsmsSimCard $parameters)
    {
      return $this->__soapCall('sendsmsSimCard', array($parameters));
    }

    /**
     * <b>متد ارسال اس ام اس بدون پارامتر api.</b>
     *
     * @param sendsms2 $parameters
     * @access public
     * @return sendsms2Response
     */
    public function sendsms2(sendsms2 $parameters)
    {
      return $this->__soapCall('sendsms2', array($parameters));
    }

    /**
     * <b>متد ارسال اس ام اس.</b>
     *
     * @param sendsms $parameters
     * @access public
     * @return sendsmsResponse
     */
    public function sendsms(sendsms $parameters)
    {
      return $this->__soapCall('sendsms', array($parameters));
    }

    /**
     * <b>حذف ارسال اس ام اس آينده</b>
     *
     * @param Delsendsmsfuture $parameters
     * @access public
     * @return DelsendsmsfutureResponse
     */
    public function Delsendsmsfuture(Delsendsmsfuture $parameters)
    {
      return $this->__soapCall('Delsendsmsfuture', array($parameters));
    }

    /**
     * <b>متد ارسال اس ام اس آينده</b>
     *
     * @param sendsmsfuture $parameters
     * @access public
     * @return sendsmsfutureResponse
     */
    public function sendsmsfuture(sendsmsfuture $parameters)
    {
      return $this->__soapCall('sendsmsfuture', array($parameters));
    }

    /**
     * <b>متد ارسال اس ام اس آينده2</b>
     *
     * @param sendsmsfuture2 $parameters
     * @access public
     * @return sendsmsfuture2Response
     */
    public function sendsmsfuture2(sendsmsfuture2 $parameters)
    {
      return $this->__soapCall('sendsmsfuture2', array($parameters));
    }

    /**
     * <b>متد ارسال نظير به نظير</b>
     *
     * @param NazirSend $parameters
     * @access public
     * @return NazirSendResponse
     */
    public function NazirSend(NazirSend $parameters)
    {
      return $this->__soapCall('NazirSend', array($parameters));
    }

    /**
     * <b>شمارنده کاراکترهاي اس ام اس.</b>
     *
     * @param smscounter $parameters
     * @access public
     * @return smscounterResponse
     */
    public function smscounter(smscounter $parameters)
    {
      return $this->__soapCall('smscounter', array($parameters));
    }

    /**
     * <b>اعتبارسنجي کاربران</b>
     *
     * @param Credites $parameters
     * @access public
     * @return CreditesResponse
     */
    public function Credites(Credites $parameters)
    {
      return $this->__soapCall('Credites', array($parameters));
    }

    /**
     * <b>دريافت پيامک کاربران</b>
     *
     * @param GetAllMessageArray $parameters
     * @access public
     * @return GetAllMessageArrayResponse
     */
    public function GetAllMessageArray(GetAllMessageArray $parameters)
    {
      return $this->__soapCall('GetAllMessageArray', array($parameters));
    }

    /**
     * <b>متد بازگشت بانک جنسيت.</b>
     *
     * @param GetBankId $parameters
     * @access public
     * @return GetBankIdResponse
     */
    public function GetBankId(GetBankId $parameters)
    {
      return $this->__soapCall('GetBankId', array($parameters));
    }

    /**
     * <b>تعداد شماره موجود در بانک جنسيت.</b>
     *
     * @param GetCountSms $parameters
     * @access public
     * @return GetCountSmsResponse
     */
    public function GetCountSms(GetCountSms $parameters)
    {
      return $this->__soapCall('GetCountSms', array($parameters));
    }

    /**
     * <b>ارسال اس ام اس جنسيت</b>
     *
     * @param SendBulkSms $parameters
     * @access public
     * @return SendBulkSmsResponse
     */
    public function SendBulkSms(SendBulkSms $parameters)
    {
      return $this->__soapCall('SendBulkSms', array($parameters));
    }

    /**
     * <b>دريافت پيامک کاربران</b>
     *
     * @param GetAllMessage $parameters
     * @access public
     * @return GetAllMessageResponse
     */
    public function GetAllMessage(GetAllMessage $parameters)
    {
      return $this->__soapCall('GetAllMessage', array($parameters));
    }

    /**
     * <b>تاريخ شروع و پايان پنل کاربران</b>
     *
     * @param GetUserExp $parameters
     * @access public
     * @return GetUserExpResponse
     */
    public function GetUserExp(GetUserExp $parameters)
    {
      return $this->__soapCall('GetUserExp', array($parameters));
    }

    /**
     * <b>دفترجه تلفن کاربران</b>
     *
     * @param GetUserContact $parameters
     * @access public
     * @return GetUserContactResponse
     */
    public function GetUserContact(GetUserContact $parameters)
    {
      return $this->__soapCall('GetUserContact', array($parameters));
    }

    /**
     * <b>دفترجه تلفن کاربران</b>
     *
     * @param GetUserContactArray $parameters
     * @access public
     * @return GetUserContactArrayResponse
     */
    public function GetUserContactArray(GetUserContactArray $parameters)
    {
      return $this->__soapCall('GetUserContactArray', array($parameters));
    }

    /**
     * <b>شماره اختصاصي کاربران</b>
     *
     * @param GetUserNumberArray $parameters
     * @access public
     * @return GetUserNumberArrayResponse
     */
    public function GetUserNumberArray(GetUserNumberArray $parameters)
    {
      return $this->__soapCall('GetUserNumberArray', array($parameters));
    }

    /**
     * <b>2شناسايي کاربران</b>
     *
     * @param Logins2 $parameters
     * @access public
     * @return Logins2Response
     */
    public function Logins2(Logins2 $parameters)
    {
      return $this->__soapCall('Logins2', array($parameters));
    }

    /**
     * <b>شناسايي کاربران</b>
     *
     * @param Logins $parameters
     * @access public
     * @return LoginsResponse
     */
    public function Logins(Logins $parameters)
    {
      return $this->__soapCall('Logins', array($parameters));
    }

    /**
     * <b>استان هاي ارسال جنسيت</b>
     *
     * @param GetState $parameters
     * @access public
     * @return GetStateResponse
     */
    public function GetState(GetState $parameters)
    {
      return $this->__soapCall('GetState', array($parameters));
    }

    /**
     * <b>شهر هاي ارسال جنسيت</b>
     *
     * @param GetCities $parameters
     * @access public
     * @return GetCitiesResponse
     */
    public function GetCities(GetCities $parameters)
    {
      return $this->__soapCall('GetCities', array($parameters));
    }

    /**
     * <b>گزارش ارسال اس ام اس کاربران</b>
     *
     * @param GetAllSendSmsArray $parameters
     * @access public
     * @return GetAllSendSmsArrayResponse
     */
    public function GetAllSendSmsArray(GetAllSendSmsArray $parameters)
    {
      return $this->__soapCall('GetAllSendSmsArray', array($parameters));
    }

    /**
     * <b>ورژن نرم افزار اندرويد</b>
     *
     * @param GetVerAndroid $parameters
     * @access public
     * @return GetVerAndroidResponse
     */
    public function GetVerAndroid(GetVerAndroid $parameters)
    {
      return $this->__soapCall('GetVerAndroid', array($parameters));
    }

    /**
     * <b>متد ارسال اس ام اس با شناسه.</b>
     *
     * @param sendsmsGuid $parameters
     * @access public
     * @return sendsmsGuidResponse
     */
    public function sendsmsGuid(sendsmsGuid $parameters)
    {
      return $this->__soapCall('sendsmsGuid', array($parameters));
    }

}
