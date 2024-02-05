<?php

declare(strict_types=1);

use App\Lib\CheckoutStrategies\ChristmasDiscountStrategy;
use App\Lib\CheckoutStrategies\DefaultStrategy;
use App\v1\Checkout;
use PHPUnit\Framework\TestCase;

final class CheckoutTest extends TestCase
{
  public function testCanAddCartItems(): void
  {
    $pricing_rules = new DefaultStrategy();
    $co = new Checkout($pricing_rules);
    $co->scan("FR1");
    $co->scan("SR1");
    $co->scan("CF1");
    $carts_items = $co->get_cart_items();

    $this->assertCount(3, $carts_items, "Cart size is NOT OK");
    $this->assertEquals(["FR1", "SR1", "CF1"], array_keys($carts_items), "Cart items NOT OK");
  }

  public function testCheckoutWithDefaultStrategy(): void
  {
    $pricing_rules = new DefaultStrategy();
    $co = new Checkout($pricing_rules);
    $co->scan("FR1");
    $co->scan("SR1");
    $co->scan("CF1");

    $this->assertEquals(19.34, $co->total);
  }

  public function testDefaultStrategyMultipleItems(): void
  {
    $pricing_rules = new DefaultStrategy();
    $basket = ["FR1", "SR1", "FR1", "FR1", "CF1"];
    $co = new Checkout($pricing_rules);

    foreach ($basket as $item) {
      $co->scan($item);
    }

    $total = $co->total;

    $this->assertEquals(22.45, $total);
  }

  public function testXmasDiscountStrategy(): void
  {
    $pricing_rules = new ChristmasDiscountStrategy();
    $basket = ["FR1", "SR1", "CF1"];
    $co = new Checkout($pricing_rules);

    foreach ($basket as $item) {
      $co->scan($item);
    }

    $total = $co->total;

    $this->assertEquals(13.604, $total);
  }
}
