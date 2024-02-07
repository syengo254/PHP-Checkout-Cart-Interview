<?php

namespace App;

use stdClass;

class Container
{
    protected $bindings = [];

    public function bind(string $key, callable $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("{$key} could be resolved in container.");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }

    public function buildObject(string $class)
    {
        $reflection = new \ReflectionClass($class);
        $params = $reflection->getConstructor()->getParameters();
        $args = [];

        foreach ($params as $param) {
            $type_name = $param->getType()?->getName();

            $argObj = null;

            if (array_key_exists($type_name, $this->bindings)) {
                $argObj = $this->resolve($type_name);
            } else {
                $argObj = new ($type_name);
            }

            $args[] = $argObj;
        }

        return $reflection->newInstance(...$args);
    }
}
