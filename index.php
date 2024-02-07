<?php

use App\v1\Checkout;

require 'functions.php';
require_once("vendor/autoload.php");
require "bootstrap.php";

// Test 1
echo '<br /> Test 1:';
$co = $container->buildObject(Checkout::class);

$co->scan("FR1");
$co->scan("SR1");
$co->scan("CF1");
$price = $co->total;
echo "£" . number_format($price, 2);

// $co->print_cart();
