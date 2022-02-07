<?php

declare(strict_types=1);

namespace MyParcelCom\TrackingModule\CarrierCode\Exception;

use Exception;

class CarrierNotSupportedException extends Exception
{
    public function __construct(private string $carrierCode)
    {
        parent::__construct('No carrier found with code ' . $this->carrierCode);
    }
}
