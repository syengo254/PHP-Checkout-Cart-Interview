<?php
require_once("vendor/autoload.php");

use App\Lib\CheckoutStrategies\DefaultStrategy;
use App\v1\Checkout;

// Test 1
echo '<br /> Test 1:';
$pricing_rules = new DefaultStrategy();
$co = new Checkout($pricing_rules);
$co->scan("FR1");
$co->scan("SR1");
$co->scan("CF1");
$price = $co->total;
echo "£" . number_format($price, 2);

// Test 2
// FR1, SR1, FR1, FR1, CF1
echo '<br /> Test 2:';

$basket = ["FR1", "SR1", "FR1", "FR1", "CF1"];
$co = new Checkout($pricing_rules);

foreach ($basket as $item) {
  $co->scan($item);
}

$price = $co->total;
echo "£" . number_format($price, 2);

// Test 3
// FR1, FR1
echo '<br /> Test 3:';

$basket = ["FR1", "FR1"];
$co = new Checkout($pricing_rules);

foreach ($basket as $item) {
  $co->scan($item);
}

$price = $co->total;
echo "£" . number_format($price, 2);

// Test 4
// SR1, SR1, FR1, SR1
echo '<br /> Test 4:';

$basket = ["SR1", "SR1", "FR1", "SR1"];
$co = new Checkout($pricing_rules);

foreach ($basket as $item) {
  $co->scan($item);
}

$price = $co->total;
echo "£" . number_format($price, 2);

// $co->print_cart();
