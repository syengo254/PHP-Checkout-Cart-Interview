<?php

namespace App\v1;

use App\Lib\CheckoutStrategies\CheckoutStrategyInterface;

class Checkout
{
  // looks like this ["FR1" => 2, "SR1" => 1, ...]
  private $cart = [];
  private CheckoutStrategyInterface $pricing_rules;

  public $total = 0;

  public function __construct(CheckoutStrategyInterface $pricing_rules)
  {
    $this->pricing_rules = $pricing_rules;
  }

  public function set_pricing_rules(CheckoutStrategyInterface $pricing_rules): void
  {
    $this->pricing_rules = $pricing_rules;
  }

  public function scan(string $product_code)
  {
    //check if in cart and update item count.
    if (array_key_exists($product_code, $this->cart)) {
      $this->cart[$product_code] += 1;
    } else {
      $this->cart += [$product_code => 1];
    }

    // update new cart total
    $this->total = $this->pricing_rules->calculate_total(...$this->cart);
  }

  public function get_cart_items(): array
  {
    return $this->cart;
  }

  public function print_cart(): void
  {
    echo "<pre>";
    print_r($this->cart);
    echo "</pre>";
  }
}
