<?php

// bind all strategies to the app container

use App\Container;
use App\Lib\CheckoutStrategies\CheckoutStrategyInterface;
use App\Lib\CheckoutStrategies\ChristmasDiscountStrategy;
use App\Lib\CheckoutStrategies\DefaultStrategy;

$container = new Container();
$container->bind(CheckoutStrategyInterface::class, function () {
    return new DefaultStrategy();
});

$container->bind(DefaultStrategy::class, function () {
    return new DefaultStrategy();
});
$container->bind(ChristmasDiscountStrategy::class, function () {
    return new ChristmasDiscountStrategy();
});
