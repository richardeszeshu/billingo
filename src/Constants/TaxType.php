<?php

namespace RichardEszes\Billingo\Constants;

abstract class TaxType
{
    const VALUES = [
        'FOREIGN',
        'HAS_TAX_NUMBER',
        'NO_TAX_NUMBER'
    ];
}