<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Clinic Info
    |--------------------------------------------------------------------------
    |
    | Fallback values used by new ClinicService detail/category pages when a
    | record doesn't override its own address/hours (single-location clinic).
    | Sourced from the sitewide JSON-LD block in layouts/app.blade.php.
    |
    */

    'name' => 'ZOW Vetique',

    'phone' => '+6281295911911',

    'whatsapp_number' => '6281295911911',

    'address' => [
        'street' => 'Jl. Prapanca Raya No.25A, RT.2/RW.3, Pulo, Kec. Kby. Baru',
        'locality' => 'Kota Jakarta Selatan',
        'region' => 'Daerah Khusus Ibukota Jakarta',
        'postal_code' => '12160',
        'country' => 'ID',
        'full' => 'Jl. Prapanca Raya No.25A, RT.2/RW.3, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12160',
    ],

    'map_url' => 'https://maps.app.goo.gl/7nqSYBnUKGHxvoKSA',

    'geo' => [
        'latitude' => -6.2530661,
        'longitude' => 106.8084629,
    ],

    'operating_hours' => [
        'label' => 'Setiap Hari 07:00 - 22:00',
        'schema' => 'Mo-Su 07:00-22:00',
    ],
];
