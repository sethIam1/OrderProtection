<?php
namespace Ecommerce121\OrderProtection\Plugin\GraphQl;

use Magento\QuoteGraphQl\Model\Resolver\PlaceOrder;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Ecommerce121\OrderProtection\Model\Validator\GraphQlInputValidator;

class PlaceOrderPlugin
{
    private $inputValidator;

    public function __construct(GraphQlInputValidator $inputValidator)
    {
        $this->inputValidator = $inputValidator;
    }

    public function beforeResolve(
        PlaceOrder $subject,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (isset($args['input']['billing_address'])) {
            $billingAddress = $args['input']['billing_address'];
            $this->inputValidator->validateName($billingAddress['firstname'], 'First Name');
            $this->inputValidator->validateName($billingAddress['lastname'], 'Last Name');
        }

        return [$field, $context, $info, $value, $args];
    }
}
