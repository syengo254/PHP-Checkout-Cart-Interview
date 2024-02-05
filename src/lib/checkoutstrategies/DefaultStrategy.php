<?php

namespace App\Lib\CheckoutStrategies;

use App\Models\Products;

/**
 * 
 * Represents the type of strategy to use. It implements the CheckoutStrategyInterface
 * Rules Buy one FR1 get one free, 3 or more strawberries price at £4.50
 */
class DefaultStrategy implements CheckoutStrategyInterface
{
  private string $strategy_name = "Default strategy";
  private float $strawberry_discount_price = 4.50;
  private float $strawberry_discount_qty = 3;
  private string $buy_get_one_free_code = "FR1";

  // calculate this strategy's total
  public function calculate_total(...$items): float
  {
    $total = 0;

    foreach ($items as $key => $quantity) {
      $product = (new Products())->get_product($key);

      if ($key == $this->buy_get_one_free_code) {
        $total += (floor($quantity / 2) * $product["price"]) + ($quantity % 2 * $product["price"]);
      } elseif ($key == "SR1" && $quantity >= $this->strawberry_discount_qty) {
        $total += $quantity * $this->strawberry_discount_price;
      } else {
        $total += $quantity * $product["price"];
      }
    }

    return $total;
  }

  public function get_name(): string
  {
    return $this->strategy_name;
  }
}
