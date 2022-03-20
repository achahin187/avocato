<?php

//created_by: Omarmm

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class VodafoneSMS
{
      protected $Account_ID =   null;

      protected $API_Password = null;

      protected $Sender_name = null;
    
      protected $Secret_key =  null;

     // protected $IP = null;


     public function __construct()
	{
	  $this->Account_ID =   "101006527";

     $this->API_Password = "Voda@1234";


      $this->Sender_name = "Avocato";
    
      $this->Secret_key =  "C4129F0384BC481A975961D6887DFF5B";

    //  $this->IP = "195.154.154.113";

	}

	public function send($to, $code , $login)
	{
		// $to =  user mobile number
		// $code = sms text body ** Note : Ignore as you can special characters 
     
     $body = 'Dear Customer your verification code is: '.$code ;

		$concatenated_values = 'AccountId='.$this->Account_ID.'&Password='.$this->API_Password.'&SenderName='.$this->Sender_name.'&ReceiverMSISDN='.$to.'&SMSText='.$body.'';

		$SecureHash =  $this->generateKey($concatenated_values);
    // Don't add any spaces in the following xml code
    $xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<SubmitSMSRequest xmlns="http://www.edafa.com/web2sms/sms/model/" xmlns:xsi="http://www.w3.org/2001/XMLSchemainstance" xsi:schemaLocation="http://www.edafa.com/web2sms/sms/model/ SMSAPI.xsd " xsi:type="SubmitSMSRequest">
    <AccountId>$this->Account_ID</AccountId>
    <Password>$this->API_Password</Password>
    <SecureHash>$SecureHash</SecureHash>
    <SMSList>
        <SenderName>$this->Sender_name</SenderName>
        <ReceiverMSISDN>$to</ReceiverMSISDN>
        <SMSText>$body</SMSText>
    </SMSList>
</SubmitSMSRequest>
XML;

    $xmlparse = new \SimpleXMLElement($xmlstr);
    // request in xml format 
    $xmlr  =$xmlparse->asXML();

     // use Guzzle to post xml  request
         $uri = 'https://e3len.vodafone.com.eg/web2sms/sms/submit/';
         $client = new Client();

         $request = new Request(
         'POST', 
         $uri,
         ['Content-Type' => 'application/xml; charset=UTF8' ,'debug' => true],

         $xmlr

         );

         $response = $client->send($request);
        //   echo $response->getBody();
	}


  public static function send_reply($to,$consultation_answer)
  {
   
    $body = 'your Consultation Answer is : ('.$consultation_answer.') ' ;

		$concatenated_values = 'AccountId='.(new self)->Account_ID.'&Password='.(new self)->API_Password.'&SenderName='.(new self)->Sender_name.'&ReceiverMSISDN='.$to.'&SMSText='.$body.'';

		$SecureHash =  (new self)->generateKey($concatenated_values);
    // Don't add any spaces in the following xml code
    $xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<SubmitSMSRequest xmlns="http://www.edafa.com/web2sms/sms/model/" xmlns:xsi="http://www.w3.org/2001/XMLSchemainstance" xsi:schemaLocation="http://www.edafa.com/web2sms/sms/model/ SMSAPI.xsd " xsi:type="SubmitSMSRequest">
    <AccountId>(new self)->Account_ID</AccountId>
    <Password>(new self)->API_Password</Password>
    <SecureHash>$SecureHash</SecureHash>
    <SMSList>
        <SenderName>(new self)->Sender_name</SenderName>
        <ReceiverMSISDN>$to</ReceiverMSISDN>
        <SMSText>$body</SMSText>
    </SMSList>
</SubmitSMSRequest>
XML;

    $xmlparse = new \SimpleXMLElement($xmlstr);
    // request in xml format 
    $xmlr  =$xmlparse->asXML();

     // use Guzzle to post xml  request
         $uri = 'https://e3len.vodafone.com.eg/web2sms/sms/submit/';
         $client = new Client();

         $request = new Request(
         'POST', 
         $uri,
         ['Content-Type' => 'application/xml; charset=UTF8' ,'debug' => true],

         $xmlr

         );

         $response = $client->send($request);
  }


	public function generateKey($concatenated_values)
	{
		
        $hash =  hash_hmac('SHA256',$concatenated_values,$this->Secret_key);
        $hash = strtoupper($hash);
        return $hash ; 

	}


}