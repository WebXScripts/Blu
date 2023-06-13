<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default method
    |--------------------------------------------------------------------------
    |
    | This option controls the default method that will be used to check
    | the website. The available methods are: "Http", "Curl".
    |
    */

    'method' => \Scrapper\Http\Http::class,

    /*
    |--------------------------------------------------------------------------
    | Default queue
    |--------------------------------------------------------------------------
    |
    | This option controls the default queue that will be used to check.
    |
     */

    'queue' => 'default',
];
