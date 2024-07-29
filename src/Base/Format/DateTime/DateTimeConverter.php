<?php

namespace AllSrvs\Base\Format\DateTime;

use DateTime;
use DateTimeInterface;

class DateTimeConverter
{
    // List of all date format constants in DateTime
    const DateTimeFormats = [
        'ATOM' => DateTimeInterface::ATOM, // 'Y-m-d\TH:i:sP'
        'COOKIE' => DateTimeInterface::COOKIE, // 'l, d-M-y H:i:s T'
        'ISO8601' => DateTimeInterface::ISO8601, // 'Y-m-d\TH:i:sO'
        'RFC822' => DateTimeInterface::RFC822, // 'D, d M y H:i:s O'
        'RFC850' => DateTimeInterface::RFC850, // 'l, d-M-y H:i:s T'
        'RFC1036' => DateTimeInterface::RFC1036, // 'D, d M y H:i:s O'
        'RFC1123' => DateTimeInterface::RFC1123, // 'D, d M Y H:i:s O'
        'RFC2822' => DateTimeInterface::RFC2822, // 'D, d M Y H:i:s O'
        'RFC3339' => DateTimeInterface::RFC3339, // 'Y-m-d\TH:i:sP'
        'RFC3339_EXTENDED' => DateTimeInterface::RFC3339_EXTENDED, // 'Y-m-d\TH:i:s.vP'
        'RSS' => DateTimeInterface::RSS, // 'D, d M Y H:i:s O'
        'W3C' => DateTimeInterface::W3C, // 'Y-m-d\TH:i:sP'
        'YMD' => 'Y-m-d',
        'YMD_HIS' => 'Y-m-d H:i:s',
        'YMD_HIS_TZ' => 'Y-m-d H:i:s T',
        'DMY' => 'd-m-Y',
        'DMY_HIS' => 'd-m-Y H:i:s',
        'DMY_HIS_TZ' => 'd-m-Y H:i:s T',
    ];

    static function getSupportedFormats(): array
    {
        return array_keys(self::DateTimeFormats);
    }

    static function convertFromSupportedDateTimeFormat(string $date): ?DateTime
    {
        foreach (self::DateTimeFormats as $name => $format) {
            $dateTime = DateTime::createFromFormat($format, $date);
            if ($dateTime !== false) {
                return $dateTime;
            }
        }
        return null;
    }

    static function convertFromCustomDateTimeFormat(string $date, string $format): ?DateTime
    {
        $dateTime = DateTime::createFromFormat($format, $date);
        return $dateTime !== false ? $dateTime : null;
    }

}