<?php

class Dfordz_AgeVerification_Model_Observer 
{
    public function verifyAge(Varien_Event_Observer $observer)
    {
        $firstname = $observer->getEvent()->getQuote()->getData('customer_firstname');
        $lastname = $observer->getEvent()->getQuote()->getData('customer_lastname');
        $email = $observer->getEvent()->getQuote()->getData('customer_email');
        $model = Mage::getModel('dfageverify/ageVerification');
        $notifications = Mage::getSingleton('dfageverify/notification');
        $notify = $model->callHome($firstname, $lastname, $email);
        
        //tie into onepage checkout template to provide error message via ajax on frontend -- right now simply log message (var/log/system.log) ensure logging is turned in in admin->system->developer->logging
        if($notify) {
            $notifications->addMessage('Based on the information given, you are not old enough to purchase these products.');
        } else {
            $notifications->addMessage('We have checked and you are old enough to buy these products!');
        }

    }

}
