<?php
/**
 * User: Mkang
 * Date: 2019/1/16
 * Time: 下午2:14
 */

return [
    'use'          => 'default',
    'debug'        => env('BAIDU_AIP_DEBUG', false),
    'applications' => [
        'default' => [
            'app_id'     => env('BAIDU_AIP_APP_ID'),
            'api_key'    => env('BAIDU_AIP_API_KEY'),
            'secret_key' => env('BAIDU_AIP_SECRET_KEY'),
        ],
        'speech'  => [
            'app_id'     => env('BAIDU_AIP_SPEECH_APP_ID'),
            'api_key'    => env('BAIDU_AIP_SPEECH_API_KEY'),
            'secret_key' => env('BAIDU_AIP_SPEECH_SECRET_KEY'),
        ],
    ]
];