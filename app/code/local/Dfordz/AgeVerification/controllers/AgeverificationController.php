<?php

class Dfordz_AgeVerification_AgeverificationController extends Mage_Checkout_Onepage_Controller
{
    public function indexAction()
    {
        if(!Mage::helper('dfageverify')->getEnabled()) {
            Mage::getSingleton('checkout/session')
                ->addError($this->__('Age Verification is disabled.'));
            $this->_redirect('checkout/cart');
        }

		$quote = $this->getOnepage()->getQuote();
		if (!$quote->hasItems() || $quote->getHasError()) {
			$this->_redirect('checkout/cart');
			return;
		}
		if (!$quote->validateMinimumAmount()) {
			$error = Mage::getStoreConfig('sales/minimum_order/error_message') ?
				Mage::getStoreConfig('sales/minimum_order/error_message') :
				Mage::helper('checkout')->__('Subtotal must exceed minimum order amount');
	 
			Mage::getSingleton('checkout/session')->addError($error);
			$this->_redirect('checkout/cart');
			return;
		}
		if(!Mage::getSingleton('dfageverify/ageVerification')->verfied()) {
			Mage::getSingleton('checkout/session')->addError('Based upon available information, you are not old enough to purchase tobacco products.');
			$this->_redirect('checkout/cart');
			return;
		}

		Mage::getSingleton('checkout/session')->setCartWasUpdated(false);
		Mage::getSingleton('customer/session')
			->setBeforeAuthUrl(Mage::getUrl('*/*/*', array('_secure'=>true)));
		$this->getOnepage()->initCheckout();
		$this->loadLayout();
		$this->_initLayoutMessages('customer/session');
		$this->getLayout()->getBlock('head')->setTitle($this->__('Checkout'));
		$this->renderLayout();
    }
}
