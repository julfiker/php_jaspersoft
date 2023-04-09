<?php
return [
    /*
     |
     |Jasper server url path like "http::{url}/jasperserver
     */
    "server_url" => env('JASPER_SERVER_URL', ''),

    /*
     * Jasper server credential configuration
     */
    "username" => env('JASPER_SERVER_USERNAME', ''),
    "password" => env('JASPER_SERVER_PASSWORD', '')
];
