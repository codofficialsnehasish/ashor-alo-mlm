<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    public function sendSMS($phone_number, $user_id = 0, $password = 0)
    {
        $url = 'https://api.smartping.ai/fe/api/v1/send';

        try {
            $response = Http::get($url, [
                'username' => 'ashoralo.trans',
                'password' => 'nLcTY',
                'unicode' => 'false',
                'from' => 'ASHALO',
                'to' => $phone_number,
                'dltPrincipalEntityId' => '1701173417827065605',
                'dltContentId' => '1707173497469815979',
                'text' => "Hi User, Welcome to ASHOR ALO, Your user ID ".$user_id." and password is ".$password.". Please login www.ashoralo.in",
            ]);

            if ($response->status() == 200) {
                return $response;
            } else {
                // return "Failed to send SMS. Status code: " . $response->status();
                return $response;
            }
        } catch (\Exception $e) {
            // return "An error occurred while sending the SMS: " . $e->getMessage();
            return false;
        }
    }
}
