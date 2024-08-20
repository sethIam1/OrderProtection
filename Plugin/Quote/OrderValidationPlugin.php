<?php
namespace Ecommerce121\OrderProtection\Plugin\Quote;

use Magento\Quote\Model\QuoteManagement;
use Magento\Framework\Exception\LocalizedException;

class OrderValidationPlugin
{
    public function beforeSubmit(QuoteManagement $subject, $quote, $paymentData = [])
    {
        $this->validateAddress($quote->getBillingAddress(), 'Billing');
        if (!$quote->isVirtual()) {
            $this->validateAddress($quote->getShippingAddress(), 'Shipping');
        }
        
        return [$quote, $paymentData];
    }

    private function validateAddress($address, $addressType)
    {
        $this->validateField($address->getFirstname(), $addressType . ' First Name');
        $this->validateField($address->getLastname(), $addressType . ' Last Name');
    }

    private function validateField($value, $fieldName)
    {
        if (strlen($value) > 30) {
            throw new LocalizedException(__($fieldName . ' must not exceed 30 characters.'));
        }
        if (!preg_match('/^[\p{L}\p{N}\s\-\.]+$/u', $value)) {
            throw new LocalizedException(__($fieldName . ' contains invalid characters.'));
        }
    }
}
