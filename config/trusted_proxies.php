<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudflare Edge IP Ranges
    |--------------------------------------------------------------------------
    |
    | Used by bootstrap/app.php to restrict which upstream proxies are trusted
    | to set X-Forwarded-For / X-Forwarded-Proto. If these aren't restricted,
    | any client that reaches the origin directly can spoof its IP and defeat
    | IP-keyed rate limiting (login throttling, view-counter abuse limits,
    | the Digitail public API proxy throttle, etc).
    |
    | Source of truth, refresh periodically: https://www.cloudflare.com/ips/
    | Override via TRUSTED_PROXIES env (comma-separated) if this list goes
    | stale before the next deploy.
    |
    */

    'cloudflare' => array_filter(array_map('trim', explode(',', env('TRUSTED_PROXIES', implode(',', [
        // IPv4
        '173.245.48.0/20',
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '141.101.64.0/18',
        '108.162.192.0/18',
        '190.93.240.0/20',
        '188.114.96.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
        '162.158.0.0/15',
        '104.16.0.0/13',
        '104.24.0.0/14',
        '172.64.0.0/13',
        '131.0.72.0/22',
        // IPv6
        '2400:cb00::/32',
        '2606:4700::/32',
        '2803:f800::/32',
        '2405:b500::/32',
        '2405:8100::/32',
        '2a06:98c0::/29',
        '2c0f:f248::/32',
    ]))))),

];
