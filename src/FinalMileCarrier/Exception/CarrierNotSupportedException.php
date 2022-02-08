<?php

declare(strict_types=1);

namespace MyParcelCom\FinalMileCarrier\Exception;

use Exception;

class CarrierNotSupportedException extends Exception
{
    public function __construct(private string $countryCode)
    {
        parent::__construct('No carrier found for country code ' . $this->countryCode);
    }
}
