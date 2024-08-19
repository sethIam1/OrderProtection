<?php
namespace Ecommerce121\OrderProtection\Model\Validator;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;

class GraphQlInputValidator
{
    const MAX_LENGTH = 30;

    public function validateName($value, $fieldName)
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw new GraphQlInputException(__($fieldName . ' must not exceed ' . self::MAX_LENGTH . ' characters.'));
        }
        if (!preg_match('/^[\p{L}\p{N}\s\-\.]+$/u', $value)) {
            throw new GraphQlInputException(__($fieldName . ' contains invalid characters.'));
        }
    }
}
