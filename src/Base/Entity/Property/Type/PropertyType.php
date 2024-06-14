<?php

namespace AllSrvs\Base\Entity\Property\Type;

abstract class PropertyType
{
    const NAME = "";
    abstract static function validate($value);

    protected static function isAssoc($value) {
        return is_array($value) && array_keys($value) !== range(0, count($value) - 1);
    }
}