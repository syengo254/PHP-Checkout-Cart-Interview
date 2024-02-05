<?php

namespace App\Models;

final class Products
{
  private $db = [
    "FR1" => [
      "name" => "Fruit tea",
      "price" => 3.11,
    ],
    "SR1" => [
      "name" => "Strawberries",
      "price" => 5.00,
    ],
    "CF1" => [
      "name" => "Coffee",
      "price" => 11.23,
    ],
  ];

  public function get_product(string $product_code)
  {
    return $this->db[$product_code];
  }

  public function add_product($code, $name, $price): void
  {
    $this->db[$code] = [
      "name" => $name,
      "price" => $price,
    ];
  }
}
