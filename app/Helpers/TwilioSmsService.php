<?php

//created_by: Ash

namespace App\Helpers;

use Twilio\Rest\Client;

class TwilioSmsService
{
	protected $client = null;
	protected $from   = null;

	public function __construct($twilio_config)
	{
		$this->client = new Client($twilio_config['app_id'], $twilio_config['token']);
		$this->from   = $twilio_config['from'];
	}

	public function getClient()
	{
		return $this->client;
	}

	public function send($to, $body , $password , $code)
	{
		$result['status'] = 0;
		$result['msg']    = '';

		try
		{
			$this->client->messages->create(
				$to,
				[
					'from' => $this->from,
					'body' => 'avocatoapp.com verification code is : '.$body .' And Your code is :'.$code . 'And Password is :'.$password
				]
			);

			$result['status'] = 1;
			$result['msg']    = trans('messages.sms');
		}
		catch(\Exception $e)
		{
			$result['msg'] = $e->getMessage();
		}

		return $result;
	}
	public  function send_reply($to,$consultation_answer)
	{





		$sid = 'AC2305889581179ad67b9d34540be8ecc1'; // Your Account SID from www.twilio.com/console
        $token ='2021c86af33bd8f3b69394a5059c34f0'; // Your Auth Token from www.twilio.com/console
        $from   = '+13238701693'; // tour twilio number
        try{
            $client = new Client($sid, $token);
            $message = $client->messages->create(
                $number, [
                'from' => $from, // From a valid Twilio number
                'body' => $body
                ]);
        }catch(\Exception $e ){
            //
        }
	}

}