<?php

return [
    'mailer' => [
        'key' => env('MAILER_API_KEY'),
        'endpoint' => env('MAILER_ENDPOINT', 'https://mail.example.internal'),
    ],
];
