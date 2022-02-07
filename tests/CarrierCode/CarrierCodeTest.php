<?php

declare(strict_types=1);

namespace Tests\CarrierCode;

use MyParcelCom\TrackingModule\CarrierCode\CarrierCode;
use PHPUnit\Framework\TestCase;

class CarrierCodeTest extends TestCase
{
    /** @test */
    public function itShouldGenerateACarrierUrl(): void
    {
        $this->assertEquals('https://track.bpost.cloud/btr/web/#/search?lang=fr&itemCode=%s&postalCode=3080', (new CarrierCode('bpost'))->getUrl());
    }
}
