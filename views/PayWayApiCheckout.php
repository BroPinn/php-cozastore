<?php
/*
|--------------------------------------------------------------------------
| ABA PayWay API URL
|--------------------------------------------------------------------------
| API URL that is provided by Payway must be required in your post form
|
*/
define('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase');

/*
|--------------------------------------------------------------------------
| ABA PayWay API KEY
|--------------------------------------------------------------------------
| API KEY that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_API_KEY', '');

/*
|--------------------------------------------------------------------------
| ABA PayWay MERCHANT ID
|--------------------------------------------------------------------------
| MERCHANT ID that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_MERCHANT_ID', '');

class PayWayApiCheckout {

    /**
     * Returns the getHash
     * For Payway security, you must follow the way of encryption for hash.
     * 
     * @param string $transactionId
     * @param string $amount
     * 
     * @return string getHash
     */

    public static function getHash($str) {
        // Log input string for debugging
        error_log("Input string for hash: " . $str);
        
        // Remove any whitespace
        $str = trim($str);
        
        // Generate hash
        $hash = hash_hmac('sha512', $str, ABA_PAYWAY_API_KEY, true);
        $encodedHash = base64_encode($hash);
        
        // Log generated hash
        error_log("Generated hash: " . $encodedHash);
        
        return $encodedHash;
     }

     /**
      * Returns the getApiUrl
      *
      * @return string getApiUrl
      */

    public static function getApiUrl() {
        return ABA_PAYWAY_API_URL;
    }
}

// Retrieve form data
$coupon = $_POST['coupon'] ?? '';
$items = $_POST['items'] ?? []; // Assuming items are passed as an array in the form

// Calculate total amount
$totalAmount = 0;
foreach ($items as $item) {
    $totalAmount += $item['quantity'] * $item['price'];
}

// Generate transaction ID
$transactionId = uniqid('txn_');

// Create the string to be hashed
$str = $transactionId . $totalAmount . ABA_PAYWAY_MERCHANT_ID;

// Get the hash
$hash = PayWayApiCheckout::getHash($str);

// Prepare the data to be sent to ABA PayWay
$data = [
    'transactionId' => $transactionId,
    'amount' => $totalAmount,
    'merchantId' => ABA_PAYWAY_MERCHANT_ID,
    'hash' => $hash,
    'items' => $items,
    'coupon' => $coupon
];

// Send the data to ABA PayWay API
$ch = curl_init(PayWayApiCheckout::getApiUrl());
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . ABA_PAYWAY_API_KEY
]);
$response = curl_exec($ch);
curl_close($ch);

// Handle the response from ABA PayWay
$responseData = json_decode($response, true);
if ($responseData['status'] === 'success') {
    // Redirect to a success page
    header('Location: success.php');
} else {
    // Redirect to a failure page
    header('Location: failure.php');
}
?>