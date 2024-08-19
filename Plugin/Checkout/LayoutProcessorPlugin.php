<?php
namespace Ecommerce121\OrderProtection\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class LayoutProcessorPlugin
{
    public function afterProcess(
        LayoutProcessorInterface $subject,
        array $jsLayout
    ) {
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'])) {
            foreach ($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'] as $key => $paymentMethod) {
                if (isset($paymentMethod['component']) && $paymentMethod['component'] == 'Magento_Checkout/js/view/billing-address') {
                    // max_text_length to firstname and lastname
                    if (isset($paymentMethod['children']['form-fields']['children']['firstname'])) {
                        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']['firstname']['validation']['max_text_length'] = 30;
                    }
                    if (isset($paymentMethod['children']['form-fields']['children']['lastname'])) {
                        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']['lastname']['validation']['max_text_length'] = 30;
                    }
                }
            }
        }

        return $jsLayout;
    }
}
