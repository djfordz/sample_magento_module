<?php

class Dfordz_AgeVerification_Block_Notifications extends Mage_Core_Block_Template
{
    public function _toHtml($classname = "notification-global")
    {
        Mage::dispatchEvent('dfageverify_notifications_before');

        $messages = Mage::getSingleton('dfageverify/notification')->getMessages();
        $html = null;
        foreach($messages as $message)
        {
            $html .="<div class='$classname'>" . $message . "</div>div>";
        }

        return $html;
    }
}
