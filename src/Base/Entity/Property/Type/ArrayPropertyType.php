<?php

namespace AllSrvs\Base\Entity\Property\Type;

class ArrayPropertyType extends PropertyType
{
    const NAME = 'ARRAY';
    static function validate($value): bool
    {
        return is_array($value) && !self::isAssoc($value);
    }
}