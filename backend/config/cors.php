<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Next.js（http://localhost:3000）からのリクエストを許可
    |--------------------------------------------------------------------------
    | - APIリクエストの対象パス
    | - 全てのHTTPメソッドを許可
    | - Next.jsのURLを指定
    | -全てのリクエストヘッダを許可
    | -認証付きリクエストを許可しない
    |
    |
    */

    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];