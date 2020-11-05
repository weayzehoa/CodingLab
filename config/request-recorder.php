<?php
/**
 * littleBookBoy/laravel-request-recorder Config
 */
return [
    /**
     * - enabled : true or false
     * - group : route middleware group name
     * - except : 僅記錄除了這些方法之外的請求, 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'
     * - skip_routes : 僅記錄除了這些路由之外的請求, 也可限定只排除該路由的某些 rsponse http code
     */
    'recorder' => [
        'enabled' => true,
        'group' => 'api',
        'except' => [''],
        'skip_routes' => [
            [
                'route_name' => 'route.name1',
                'http_code' => ['*']
            ],
            [
                'route_name' => 'route.name2',
                'http_code' => ['409', '422']
            ],
        ]
    ]
];