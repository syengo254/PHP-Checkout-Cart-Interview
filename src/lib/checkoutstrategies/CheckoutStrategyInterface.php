<?php

namespace App\Lib\CheckoutStrategies;

/**
 * 
 * This is the interface that any checkout strategies you create should implement
 */
interface CheckoutStrategyInterface
{
  public function calculate_total(...$items): float;
}
