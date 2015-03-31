var dataLayer = [];

dataLayer.push({
    'ecommerce': {
        'purchase': {
            'actionField': {
                'id': TRANSACTION_ID,                 // Transaction ID. Required for purchases and refunds.
                'affiliation': AFFILIATION,
                'revenue': REVENUE,                   // Total transaction value (incl. tax and shipping)
                'tax':'0',
                'shipping': '0',
                'coupon': ''
            },
            'products': [{                            // List of productFieldObjects.
                'name': PRODUCT_NAME,                 // Name or ID is required.
                'id': PRODUCT_ID,
                'price': PRODUCT_PRICE,
                'brand': PRODUCT_BRAND,
                'category': PRODUCT_CATEGORY,
                'variant': PRODUCT_VARIANT,
                'quantity': PRODUCT_QUANTITY,
                'coupon': ''                           // Optional fields may be omitted or set to empty string.
            }]
        }
    }
});
