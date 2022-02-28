<?php
// config for Ariaieboy/CaproverLaravel
return [
    // you caprover main domain that poin to the admin area
    'server'=>env('CAPROVER_SERVER'),
    // the password of your caprover admin panel
    'password'=>env('CAPROVER_PASSWORD'),
    // guzzle timeout
    'timeout'=>env('CAPROVER_TIMEOUT',60)
];
