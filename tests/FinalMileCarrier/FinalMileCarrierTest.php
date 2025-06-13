<?php

declare(strict_types=1);

namespace FinalMileCarrier;

use MyParcelCom\FinalMileCarrier\Exception\CarrierNotSupportedException;
use MyParcelCom\FinalMileCarrier\FinalMileCarrier;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FinalMileCarrierTest extends TestCase
{
    public function testItShouldGenerateACarrierUrl(): void
    {
        $this->assertEquals('https://track.bpost.cloud/btr/web/#/search?itemCode=12345678', (new FinalMileCarrier('BE', '12345678'))->getUrl());
    }

    public function testItShouldReturnTheCarrierName(): void
    {
        $this->assertEquals('bpost', (new FinalMileCarrier('BE', '12345678'))->getName());
    }

    #[DataProvider('carrierCountryCodeDataProvider')]
    public function testItShouldReturnTheTrackingCode(string $countryCode): void
    {
        $this->assertEquals('12345678', (new FinalMileCarrier($countryCode, '12345678'))->getTrackingCode());
    }

    public function testItShouldThrowAnExceptionWhenAnInvalidCountryCodeIsProvided(): void
    {
        $this->expectException(CarrierNotSupportedException::class);
        $this->expectExceptionMessage('No carrier found for country code XX');
        new FinalMileCarrier('XX', '12345678');
    }

    public static function carrierCountryCodeDataProvider(): array
    {
        return [
            ['AR'],
            ['AU'],
            ['AT'],
            ['BE'],
            ['BR'],
            ['BG'],
            ['CA'],
            ['CL'],
            ['HR'],
            ['CY'],
            ['CZ'],
            ['DK'],
            ['EG'],
            ['EE'],
            ['FI'],
            ['FR'],
            ['DE'],
            ['GH'],
            ['GR'],
            ['HK'],
            ['HU'],
            ['IS'],
            ['IN'],
            ['ID'],
            ['IE'],
            ['IT'],
            ['JP'],
            ['KP'],
            ['LV'],
            ['LT'],
            ['LU'],
            ['MY'],
            ['MT'],
            ['MX'],
            ['NL'],
            ['NZ'],
            ['NG'],
            ['NO'],
            ['PH'],
            ['PL'],
            ['PT'],
            ['RO'],
            ['RU'],
            ['SG'],
            ['SK'],
            ['SI'],
            ['ZA'],
            ['ES'],
            ['SE'],
            ['CH'],
            ['TW'],
            ['TH'],
            ['TR'],
            ['GB'],
            ['UY'],
            ['US'],
        ];
    }
}
