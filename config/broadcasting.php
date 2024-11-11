<?php

return [

    'default' => env('BROADCAST_DRIVER', 'null'),

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY', 'dc4423245c30c691395f'),  // مفتاح تطبيق Pusher
            'secret' => env('PUSHER_APP_SECRET', 'a7db3cf6cba94ba130dd'),  // سر تطبيق Pusher
            'app_id' => env('PUSHER_APP_ID', '1853283'),  // معرف تطبيق Pusher
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER', 'eu'),  // الكلاستر الخاص بالتطبيق
                'useTLS' => true,  // استخدام TLS
                'host' => env('PUSHER_HOST', 'api-'.env('PUSHER_APP_CLUSTER').'.pusher.com'),  // المضيف الافتراضي
                'port' => env('PUSHER_PORT', 443),  // المنفذ
                'scheme' => env('PUSHER_SCHEME', 'https'),  // البروتوكول
            ],
            'client_options' => [
                // إعدادات Guzzle client يمكن إضافتها هنا إذا لزم الأمر
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',  // الاتصال الافتراضي
        ],

        'log' => [
            'driver' => 'log',  // تسجيل الأحداث
        ],

        'null' => [
            'driver' => 'null',  // عدم استخدام البث
        ],

    ],

];

