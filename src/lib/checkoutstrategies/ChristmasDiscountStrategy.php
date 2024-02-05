<?php

namespace App\Lib\CheckoutStrategies;

use App\Models\Products;

/**
 * 
 * Represents the type of strategy to use. It implements the CheckoutStrategyInterface
 * With this strategy every product is price at 40% off the normal price of teas FR1 & CF1
 */
class ChristmasDiscountStrategy implements CheckoutStrategyInterface
{
  private string $strategy_name = "Xmas discount strategy";
  private float $xmas_discount_perc = 0.4; // 40%
  private array $discounted_products = ["FR1", "CF1"]; // this can even be made dynamic

  // calculate this strategy's total
  public function calculate_total(...$items): float
  {
    $total = 0;

    foreach ($items as $key => $quantity) {
      $product = (new Products())->get_product($key);
      $price = $product["price"];

      if (in_array($key, $this->discounted_products, true)) {

        $total += ($price * (1 - $this->xmas_discount_perc)) * $quantity;
      } else {
        $total += $price * $quantity;
      }
    }

    return $total;
  }

  public function get_name(): string
  {
    return $this->strategy_name;
  }
}
