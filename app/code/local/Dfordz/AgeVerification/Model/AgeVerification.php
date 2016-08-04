<?php

class Dfordz_AgeVerification_Model_AgeVerification extends Mage_Core_Model_Abstract
{
    const DEV_KEY = '8b31188d-73e4-4bf5-bfb5-04758baa36d8';

    public function callHome($firstname, $lastname, $email)
    {
        $helper = Mage::helper('dfageverify');

        if($helper->getEnabled()) {
            $url = $helper->getApiEndpoint();
            $public = $helper->getApiPublicKey();
            $private = $helper->getApiPrivateKey();
            $data = $private;

			
            $headers = array(
					'Content-Type: application/json',
					'Authorization: Basic ' . base64_encode(self::DEV_KEY . ': ')
				);

            $ch = curl_init($url . "/applications/$public/acpin/$private/check");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

            $result = curl_exec($ch);

            curl_close($ch);

            if($result) {
                $notify = json_decode($result, true);
            }
            
            return $notify["data"]["under18"];     
        }
    }

}
