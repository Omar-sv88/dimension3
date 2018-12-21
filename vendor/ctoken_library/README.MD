CTOKEN CLASS
============
A simple library to encode and decode JSON Web Tokens (JWT) in PHP, conforming to [RFC 7519](https://tools.ietf.org/html/rfc7519).

Example
-------
```php
<?php

    // Include de class's library
    require_once __DIR__.'index.php';

    // Instance the class and pass the key to enconde and decode
    $app = new CTOKEN('mypass');
    $params = [
        'name'  => 'Omar',
        'pass'  => 'pass',
        'nri'   => '880000000088'
    ];
    // Encode array $params return @string
    $token = $app->encode($params);
    // Decode Json in to Array return @array
    $decode = $app->decode($token);
