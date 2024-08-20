# OrderProtection
Block Injection Attacks in Magento 2 Checkout

This module sets a 30 character max input (30 characters per each field) for:
1. Frontend Validation (input for shipping and billing fields)
2. Backend Validation (PHP placeOrder with $quote)
3. GraphQl API Protection (via cURL or the like)

Standard Magento 2 Module: 
1. Add SethIam/OrderProtection to your App/Code directory
2. Run in the CLI: setup:upgrade, setup:di:compile, cache:flush
3. Good to go.
