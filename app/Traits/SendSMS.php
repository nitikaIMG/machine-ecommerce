<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

trait SendSMS {

    public function sendSms($phone,$otp)
    {
        $receiverNumber = "+91".$phone;
        $message = "Your otp is ". $otp;
        try {
            $account_sid = 'AC4d461711052182e47c39c1e21b6a8816';
            $auth_token = 'd3eebb2695312dbad95582eb3b1a5df9';
            $twilio_number = '+13605498573';
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
            return true;
        } catch (Exception $e) {
            return false;
            logger("Error: ". $e->getMessage());
        }
        // return true;
    }
}