<?php
// Include the Stripe PHP library
require_once("C:\xampp\htdocs\stripe-php-master\init.php");

// Set your API key
\Stripe\Stripe::setApiKey('sk_test_YourSecretKeyHere');

// Get the token from the form submission
$token = $_POST['stripeToken'];

// Get the amount to charge (in cents)
$amount = $_POST['amount'];

// Create a charge object with Stripe
$charge = \Stripe\Charge::create([
  'amount' => $amount,
  'currency' => 'usd',
  'description' => 'Example charge',
  'source' => $token,
]);

// Check if the charge was successful
if ($charge->status == 'succeeded') {
  // Charge was successful, do something with the response
  echo "Charge succeeded!";
} else {
  // Charge was not successful, handle the error
  echo "Charge failed: " . $charge->failure_message;
}