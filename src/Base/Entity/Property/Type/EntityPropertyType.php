<?php

namespace AllSrvs\Base\Entity\Property\Type;

use AllSrvs\Base\Entity;

class EntityPropertyType extends PropertyType
{
    const NAME = 'ENTITY';
    static function validate($value): bool
    {
        return $value instanceof Entity;
    }
}