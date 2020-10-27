<?php
$cart= new Base\actionPanier();
// Product Details
// Minimum amount is $0.50 US
$itemName = "Demo Product";
$itemNumber = "PN12345";
$itemPrice = "";
$currency = "EUR";

// Stripe API configuration
define('STRIPE_API_KEY', 'sk_test_51HgTpGLtuZgtK0iJZZNbHgCWcswe92aWJOGIeK5hFTUZ7wRUXQQDzSQTTWLjGoSVY0O978roeY5A0RyIiiomZlPN00xDfUp1w5');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51HgTpGLtuZgtK0iJM6Z9TRzIP0sywAv38DodZRUWHN3ZOg48fOrT5aNLdZNgEYvlQzvqzymxpIMQ76Udecu3NZpb0088vaq92Y');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'boutique');
