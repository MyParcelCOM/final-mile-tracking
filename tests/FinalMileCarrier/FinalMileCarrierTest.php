<?php

declare(strict_types=1);

namespace FinalMileCarrier;

use MyParcelCom\FinalMileCarrier\Exception\CarrierNotSupportedException;
use MyParcelCom\FinalMileCarrier\FinalMileCarrier;
use PHPUnit\Framework\TestCase;

class FinalMileCarrierTest extends TestCase
{
    /** @test */
    public function itShouldGenerateACarrierUrl(): void
    {
        $this->assertEquals('https://track.bpost.cloud/btr/web/#/search?lang=fr&itemCode=12345678&postalCode=3080', (new FinalMileCarrier('BE', '12345678'))->getUrl());
    }

    /** @test */
    public function itShouldReturnTheCarrierName(): void
    {
        $this->assertEquals('bpost', (new FinalMileCarrier('BE', '12345678'))->getName());
    }

    /** @test */
    public function itShouldThrowAnExceptionWhenAnInvalidCountryCodeIsProvided(): void
    {
        $this->expectException(CarrierNotSupportedException::class);
        $this->expectExceptionMessage('No carrier found for country code XX');
        new FinalMileCarrier('XX', '12345678');
    }
}
