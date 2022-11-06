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
    | AAM - Alanyi adómentesség
    | ANTIQUES - Különbözet szerinti szabályozás - gyűjteménydarabok és régiségek -
    | ARTWORK - Különbözet szerinti szabályozás - műalkotások -
    | ATK - Áfa tv. tárgyi hatályán kívüli ügylet
    | EAM - Áfamentes termékexport, azzal egy tekintet alá eső értékesítések, nemzetközi közlekedéshez kapcsolódó áfamentes ügyletek (Áfa tv. 98-109. §)
    | EUE - EU más tagállamában áfaköteles (áfa fizetésére az értékesítő köteles)
    | EUFAD37 - Áfa tv. 37. § (1) bekezdése alapján a szolgáltatás teljesítése helye az EU más tagállama (áfa fizetésére a vevő köteles)
    | EUFADE - Áfa tv. egyéb rendelkezése szerint a teljesítés helye EU más tagállama (áfa fizetésére a vevő kötelezett)
    | HO - Áfa tv. szerint EU-n kívül teljesített ügylet
    | KBAET - Más tagállamba irányuló áfamentes termékértékesítés (Áfa tv. 89. §)
    | NAM_1 - Áfamentes közvetítői tevékenység (Áfa tv. 110. §)
    | NAM_2 - Termékek nemzetközi forgalmához kapcsolódó áfamentes ügylet (Áfa tv. 111-118. §)
    | SECOND_HAND - Különbözet szerinti szabályozás - használt cikkek -
    | TAM - Tevékenység közérdekű jellegére vagy egyéb sajátos jellegére tekintettel áfamentes (Áfa tv. 85-87.§)
    | TRAVEL_AGENCY - Különbözet szerinti szabályozás - utazási irodák
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
        'MAA', 'TAM', 'ÁKK', 'ÁTHK'
    ],
];