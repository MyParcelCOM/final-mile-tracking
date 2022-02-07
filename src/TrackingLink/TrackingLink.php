<?php

declare(strict_types=1);

namespace MyParcelCom\TrackingModule\TrackingLink;

use Exception;
use MyParcelCom\TrackingModule\CarrierCode\CarrierCode;

class TrackingLink
{
    private CarrierCode $carrierCode;

    public function __construct(private string $trackingCode, string $carrierCode)
    {
        $this->carrierCode = new CarrierCode($carrierCode);
    }

    /**
     * @throws Exception
     */
    public function getUrl(): string
    {
        return sprintf($this->carrierCode->getUrl(), $this->trackingCode);
    }
}
