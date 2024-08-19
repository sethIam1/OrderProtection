<?php
namespace Ecommerce121\OrderProtection\Plugin\GraphQl;

use Magento\QuoteGraphQl\Model\Resolver\SetBillingAddressOnCart;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Ecommerce121\OrderProtection\Model\Validator\GraphQlInputValidator;

class BillingAddressPlugin
{
    private $inputValidator;

    public function __construct(GraphQlInputValidator $inputValidator)
    {
        $this->inputValidator = $inputValidator;
    }

    public function beforeResolve(
        SetBillingAddressOnCart $subject,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (isset($args['input']['billing_address']['address'])) {
            $address = $args['input']['billing_address']['address'];
            $this->inputValidator->validateName($address['firstname'], 'First Name');
            $this->inputValidator->validateName($address['lastname'], 'Last Name');
        }

        return [$field, $context, $info, $value, $args];
    }
}
