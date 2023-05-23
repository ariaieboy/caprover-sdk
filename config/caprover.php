<?php
// config for Ariaieboy/Caprover-sdk
return [
    // Your Caprover main domain that point to the admin area
    'server'=>env('CAPROVER_SERVER'),
    // The password of your Caprover admin panel
    'password'=>env('CAPROVER_PASSWORD'),
    // Guzzle timeout in seconds
    'timeout'=>env('CAPROVER_TIMEOUT',60)
];
