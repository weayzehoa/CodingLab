<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. This file
    | is published to the application config directory for modification by the
    | user. The full set of possible options are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
    ],
    // 'region' => env('AWS_DEFAULT_REGION'),
    'version' => 'latest',

    // You can override settings for specific services
    's3' => [
        'region' => env('AWS_S3_DEFAULT_REGION'),
    ],
    'sns' => [
        'region' => env('AWS_SNS_DEFAULT_REGION'),
    ],
    'ses' => [
        'region' => env('AWS_SES_DEFAULT_REGION'),
    ]
];
