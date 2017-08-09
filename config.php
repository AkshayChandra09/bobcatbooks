<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_wqfClDDBIAMuIOvsWURkSRWL",
  "publishable_key" => "pk_test_itQnTb8Y1LFz9hPTDvI0IELO"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>