<?php

return [
    /*
    |
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | Set the Billingo API's base URL.
    |
    */
    'baseUrl' => env('BILLINGO_BASEURL', 'https://api.billingo.hu/'),

    /*
    |
    |--------------------------------------------------------------------------
    | Billingo API key
    |--------------------------------------------------------------------------
    |
    | Billingo API key.
    |
    | More info: https://flareapp.io/docs/general/projects
    |
    */
    'apikey' => env('BILLINGO_APIKEY'),

    /*
    |
    |--------------------------------------------------------------------------
    | Billingo block ID
    |--------------------------------------------------------------------------
    |
    | Specify which block will be used to create invoices.
    |
    | More info: https://flareapp.io/docs/general/projects
    |
    */
    'blockId' => env('BILLINGO_BLOCKID'),

    /*
    |
    |--------------------------------------------------------------------------
    | Available country codes
    |--------------------------------------------------------------------------
    |
    | List of available country codes which accepted by Billingo.
    |
    */
    'countryCodes' => [
        'AC', 'AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AW', 'AX', 'AZ', 'BA', 'BB', 'BD', 
        'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO', 'BQ', 'BR', 'BS', 'BT', 'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 
        'CF', 'CG', 'CH', 'CI', 'CK', 'CL', 'CM', 'CN', 'CO', 'CR', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DE', 'DG', 'DJ', 'DK', 
        'DM', 'DO', 'DZ', 'EA', 'EC', 'EE', 'EG', 'EH', 'ER', 'ES', 'ET', 'FI', 'FJ', 'FK', 'FM', 'FO', 'FR', 'GA', 'GB', 'GD', 
        'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU', 'GW', 'GY', 'HK', 'HN', 'HR', 'HT', 
        'HU', 'IC', 'ID', 'IE', 'IL', 'IM', 'IN', 'IO', 'IQ', 'IR', 'IS', 'IT', 'JE', 'JM', 'JO', 'JP', 'KE', 'KG', 'KH', 'KI', 
        'KM', 'KN', 'KP', 'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY', 'MA', 'MC', 
        'MD', 'ME', 'MF', 'MG', 'MH', 'MK', 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR', 'MS', 'MT', 'MU', 'MV', 'MW', 'MX', 'MY', 
        'MZ', 'NA', 'NC', 'NE', 'NF', 'NG', 'NI', 'NL', 'NO', 'NP', 'NR', 'NU', 'NZ', 'OM', 'PA', 'PE', 'PF', 'PG', 'PH', 'PK', 
        'PL', 'PM', 'PN', 'PR', 'PS', 'PT', 'PW', 'PY', 'QA', 'RE', 'RO', 'RS', 'RU', 'RW', 'SA', 'SB', 'SC', 'SD', 'SE', 'SG', 
        'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO', 'SR', 'SS', 'ST', 'SV', 'SX', 'SY', 'SZ', 'TA', 'TC', 'TD', 'TF', 'TG', 
        'TH', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TW', 'TZ', 'UA', 'UG', 'UM', 'US', 'UY', 'UZ', 'VA', 'VC', 
        'VE', 'VG', 'VI', 'VN', 'VU', 'WF', 'WS', 'XA', 'XB', 'XK', 'YE', 'YT', 'ZA', 'ZM', 'ZW'
    ],

    /*
    |
    |--------------------------------------------------------------------------
    | Available entitlements
    |--------------------------------------------------------------------------
    |
    | List of available entitlements which accepted by Billingo.
    | 
    | AAM - Alanyi ad??mentess??g
    | ANTIQUES - K??l??nb??zet szerinti szab??lyoz??s - gy??jtem??nydarabok ??s r??gis??gek -
    | ARTWORK - K??l??nb??zet szerinti szab??lyoz??s - m??alkot??sok -
    | ATK - ??fa tv. t??rgyi hat??ly??n k??v??li ??gylet
    | EAM - ??famentes term??kexport, azzal egy tekintet al?? es?? ??rt??kes??t??sek, nemzetk??zi k??zleked??shez kapcsol??d?? ??famentes ??gyletek (??fa tv. 98-109. ??)
    | EUE - EU m??s tag??llam??ban ??fak??teles (??fa fizet??s??re az ??rt??kes??t?? k??teles)
    | EUFAD37 - ??fa tv. 37. ?? (1) bekezd??se alapj??n a szolg??ltat??s teljes??t??se helye az EU m??s tag??llama (??fa fizet??s??re a vev?? k??teles)
    | EUFADE - ??fa tv. egy??b rendelkez??se szerint a teljes??t??s helye EU m??s tag??llama (??fa fizet??s??re a vev?? k??telezett)
    | HO - ??fa tv. szerint EU-n k??v??l teljes??tett ??gylet
    | KBAET - M??s tag??llamba ir??nyul?? ??famentes term??k??rt??kes??t??s (??fa tv. 89. ??)
    | NAM_1 - ??famentes k??zvet??t??i tev??kenys??g (??fa tv. 110. ??)
    | NAM_2 - Term??kek nemzetk??zi forgalm??hoz kapcsol??d?? ??famentes ??gylet (??fa tv. 111-118. ??)
    | SECOND_HAND - K??l??nb??zet szerinti szab??lyoz??s - haszn??lt cikkek -
    | TAM - Tev??kenys??g k??z??rdek?? jelleg??re vagy egy??b saj??tos jelleg??re tekintettel ??famentes (??fa tv. 85-87.??)
    | TRAVEL_AGENCY - K??l??nb??zet szerinti szab??lyoz??s - utaz??si irod??k
    |
    */
    'entitlements' => ['AAM', 'ANTIQUES', 'ARTWORK', 'ATK', 'EAM', 'EUE', 'EUFAD37', 'EUFADE', 'HO', 'KBAET', 'NAM_1', 'NAM_2', 'SECOND_HAND', 'TAM', 'TRAVEL_AGENCY'],

    /*
    |
    |--------------------------------------------------------------------------
    | Available currencies
    |--------------------------------------------------------------------------
    |
    | List of available currencies which accepted by Billingo.
    |
    */
    'currencies' => [
        'AED', 'AUD', 'BGN', 'BRL', 'CAD', 'CHF', 'CNY', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HRK', 'HUF', 'IDR', 'ILS', 'INR', 'ISK', 
        'JPY', 'KRW', 'MXN', 'MYR', 'NOK', 'NZD', 'PHP', 'PLN', 'RON', 'RSD', 'RUB', 'SEK', 'SGD', 'THB', 'TRY', 'UAH', 'USD', 'ZAR'
    ],

    /*
    |
    |--------------------------------------------------------------------------
    | Available languages
    |--------------------------------------------------------------------------
    |
    | List of available languages which accepted by Billingo.
    |
    */
    'languages' => ['de', 'en', 'fr', 'hr', 'hu', 'it', 'ro', 'sk', 'us'],

    /*
    |
    |--------------------------------------------------------------------------
    | Available payment methods
    |--------------------------------------------------------------------------
    |
    | List of available payment methods which accepted by Billingo.
    |
    */
    'paymentMethods' => [
        'aruhitel', 'bankcard', 'barion', 'barter', 'cach', 'cash_on_delivery', 'coupon', 'elore_utalas', 'ep_kartya', 'kompenzacio', 'levonas', 
        'online_bankcard', 'other', 'paylike', 'payoneer', 'paypal', 'paypal_utolag', 'payu', 'pick_pack_pont', 'postai_csekk', 'postautalvany', 
        'skrill', 'szep_card', 'transferwise', 'upwork', 'utalvany', 'valto', 'wire_transfer'
    ],

    /*
    |
    |--------------------------------------------------------------------------
    | Available tax types
    |--------------------------------------------------------------------------
    |
    | List of available tax types which accepted by Billingo.
    |
    */
    'taxTypes' => ['FOREIGN', 'HAS_TAX_NUMBER', 'NO_TAX_NUMBER'],

    /*
    |
    |--------------------------------------------------------------------------
    | Available vat keys
    |--------------------------------------------------------------------------
    |
    | List of available vat keys which accepted by Billingo.
    |
    */
    'vatKeys' => [
        '0%', '1%', '10%', '11%', '12%', '13%', '14%', '15%', '16%', '17%', '18%', '19%', '2%', '20%', '21%', '22%', '23%', '24%', 
        '25%', '26%', '27%', '3%', '4%', '5%', '5,6%', '7%', '7,8%', '9%', '9,5%', 'AAM', 'AM', 'EU', 'EUK', 'F.AFA', 'FAD', 'K.AFA', 
        'MAA', 'TAM', '??KK', '??THK'
    ],
];