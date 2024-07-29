<?php

namespace Tests\Base\Format\DateTime;

use PHPUnit\Framework\TestCase;
use AllSrvs\Base\Format\DateTime\DateTimeConverter;
use DateTime;

class DateTimeConverterTest extends TestCase
{
    public function testConvertFromSupportedDateTimeFormat()
    {
        $date = '2023-10-05T14:30:00+00:00';
        $dateTime = DateTimeConverter::convertFromSupportedDateTimeFormat($date);
        $this->assertInstanceOf(DateTime::class, $dateTime);
        $this->assertEquals('2023-10-05T14:30:00+00:00', $dateTime->format(DateTime::RFC3339));

        $date = '2023-10-05';
        $dateTime = DateTimeConverter::convertFromSupportedDateTimeFormat($date);
        $this->assertInstanceOf(DateTime::class, $dateTime);
        $this->assertEquals('2023-10-05', $dateTime->format('Y-m-d'));

        $date = 'invalid-date';
        $dateTime = DateTimeConverter::convertFromSupportedDateTimeFormat($date);
        $this->assertNull($dateTime);
    }

    public function testConvertFromCustomDateTimeFormat()
    {
        $date = '05-10-2023';
        $format = 'd-m-Y';
        $dateTime = DateTimeConverter::convertFromCustomDateTimeFormat($date, $format);
        $this->assertInstanceOf(DateTime::class, $dateTime);
        $this->assertEquals('2023-10-05', $dateTime->format('Y-m-d'));

        $date = '14:30:00 05-10-2023';
        $format = 'H:i:s d-m-Y';
        $dateTime = DateTimeConverter::convertFromCustomDateTimeFormat($date, $format);
        $this->assertInstanceOf(DateTime::class, $dateTime);
        $this->assertEquals('2023-10-05 14:30:00', $dateTime->format('Y-m-d H:i:s'));

        $date = 'invalid-date';
        $format = 'd-m-Y';
        $dateTime = DateTimeConverter::convertFromCustomDateTimeFormat($date, $format);
        $this->assertNull($dateTime);
    }

    public function testGetSupportedFormats()
    {
        $expectedFormats = [
            'ATOM',
            'COOKIE',
            'ISO8601',
            'RFC822',
            'RFC850',
            'RFC1036',
            'RFC1123',
            'RFC2822',
            'RFC3339',
            'RFC3339_EXTENDED',
            'RSS',
            'W3C',
            'YMD',
            'YMD_HIS',
            'YMD_HIS_TZ',
            'DMY',
            'DMY_HIS',
            'DMY_HIS_TZ',
        ];

        $supportedFormats = DateTimeConverter::getSupportedFormats();
        $this->assertEquals($expectedFormats, $supportedFormats);
    }
}