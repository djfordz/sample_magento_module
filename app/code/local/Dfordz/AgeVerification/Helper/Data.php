<?php

class Dfordz_AgeVerification_Helper_Data extends Mage_Core_Helper_Data
{
    public function getEnabled()
    {
        return Mage::getStoreConfig('dfordz/api/enable');
    }

    public function getApiEndpoint()
    {
        return Mage::getStoreConfig('dfordz/api/api_endpoint');
    }

    public function getApiPublicKey()
    {
        return Mage::getStoreConfig('dfordz/api/api_public_key');
    }

    public function getApiPrivateKey()
    {
        return Mage::getStoreConfig('dfordz/api/api_private_key');
    }

    public function getMinimumAge()
    {
        return Mage::getStoreConfig('dfordz/verify_options/min_age');
    }
}
