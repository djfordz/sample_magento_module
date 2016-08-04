<?php

class Dfordz_AgeVerification_Model_Notification extends Mage_Core_Model_Abstract
{
    protected $messages = [];

    public function getMessages()
    {
        return $this->messages;
    }

    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    public function addMessage($message)
    {
        $this->messages[] = $message;
        return $this;
    }
}
