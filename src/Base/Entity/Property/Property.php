<?php

namespace AllSrvs\Base\Entity\Property;
use AllSrvs\Base\Entity\Property\Type\PropertyType;
use http\Exception\InvalidArgumentException;

class Property
{
    const TYPE = [
        'VALUE' => ['ID' => 'VALUE'],
        'ENTITY' => ['ID' => 'ENTITY'],
        'ARRAY' => ['ID' => 'ARRAY'],
    ];

    protected string $name;
    protected $value;
    protected $type;

    public function __construct(PropertyType $type, string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        if(!$this->validate($value)) {
            throw new InvalidArgumentException("Property '{$name}' has invalid type '{$type::NAME}'", 500);
        }
    }

    private function validate($value): bool {
        return $this->type::validate($value);
    }


    public function name(): string
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

}