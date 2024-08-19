<?php
namespace Ecommerce121\OrderProtection\Plugin\GraphQl;

use Magento\QuoteGraphQl\Model\Resolver\SetGuestEmailOnCart;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;

class GuestEmailValidatorPlugin
{
    public function beforeResolve(
        SetGuestEmailOnCart $subject,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (isset($args['input']['email'])) {
            $email = $args['input']['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new GraphQlInputException(__('Invalid email address format.'));
            }
            // more email validation logic here if you want
        }

        return [$field, $context, $info, $value, $args];
    }
}
