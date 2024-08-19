<?php
namespace Ecommerce121\OrderProtection\Plugin\Quote;

use Magento\Quote\Model\QuoteManagement;
use Magento\Framework\Exception\LocalizedException;

class OrderValidationPlugin
{
    public function beforeSubmit(QuoteManagement $subject, $quote, $paymentData = [])
    {
        $address = $quote->getBillingAddress();
        $this->validateField($address->getFirstname(), 'First Name');
        $this->validateField($address->getLastname(), 'Last Name');
        
        return [$quote, $paymentData];
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
