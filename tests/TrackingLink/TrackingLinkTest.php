<?php

namespace MyParcelCom\TrackingModule\Tests;

use MyParcelCom\TrackingModule\CarrierCode\Exception\CarrierNotSupportedException;
use MyParcelCom\TrackingModule\TrackingLink\TrackingLink;
use PHPUnit\Framework\TestCase;

class TrackingLinkTest extends TestCase
{
    /** @test */
    public function itShouldCreateATrackingLink(): void
    {
        $trackingLink = new TrackingLink('123456789', 'bpost');

        $this->assertEquals('https://track.bpost.cloud/btr/web/#/search?lang=fr&itemCode=123456789&postalCode=3080', $trackingLink->getUrl());
    }

    /** @test */
    public function testItShouldThrowAnExceptionWhenTrackingCodeIsInvalid(): void
    {
        $trackingLink = new TrackingLink('123456789', 'nick-post');

        $this->expectException(CarrierNotSupportedException::class);
        $trackingLink->getUrl();
    }
}
