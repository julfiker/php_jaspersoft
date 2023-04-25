<?php
return [
    /*
     |
     |Jasper server url path like "http::{url}/jasperserver
     */
    "server_url" => env('JASPER_SERVER_URL', 'http://127.0.0.1:8080'),

    /*
     * Jasper server credential configuration
     */
    "username" => env('JASPER_SERVER_USERNAME', 'jasperadmin'),
    "password" => env('JASPER_SERVER_PASSWORD', 'jasperadmin'),

    /*
     * Default 30 seconds as jasper soft client provided
     */
    'request_time_out' => env('JASPER_SERVER_REQUEST_TIMEOUT', 30)
];