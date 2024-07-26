<?php

namespace AllSrvs\Base\Entity;
class Entity implements \JsonSerializable
{
    private array $properties = [];

    public function __construct(array $value)
    {
        if (array_keys($value) !== range(0, count($value) - 1)) {
            $keys = array_keys($value);
            foreach ($keys as $key) {
                $this->__set($key, $value[$key]);
            }
        } else {
            throw new \InvalidArgumentException('Value must be an associative array');
        }
    }

    public function __set($name, $value)
    {
        if (is_scalar($value)) {
            $this->properties[$name] = $value;
        } elseif (is_array($value) && array_keys($value) !== range(0, count($value) - 1)) {
            // It's an associative array
            $this->properties[$name] = new Entity($value);
        } elseif (is_array($value)) {
            // It's an indexed array
            $processedArray = [];
            foreach ($value as $item) {
                if (is_scalar($item)) {
                    $processedArray[] = $item;
                } elseif (is_array($item) && array_keys($item) !== range(0, count($item) - 1)) {
                    // Element is an associative array
                    $processedArray[] = new self($item);
                } elseif (is_object($item)) {
                    // Element is an object (including Entity instances)
                    $processedArray[] = $item;
                }
            }
            $this->properties[$name] = $processedArray;
        }
    }

    public function __get($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function jsonSerialize()
    {
        return $this->properties;
    }

    public function __toString()
    {
        return json_encode($this->properties, JSON_PRETTY_PRINT);
    }
}