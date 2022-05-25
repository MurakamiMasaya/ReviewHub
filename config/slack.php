<?php

return [
    // Webhook URL
    'url' => env('SLACK_URL'),

    // チャンネル設定
    'default' => 'regist',

    'channels' => [
        'regist' => [
            'username' => 'ユーザーの新規登録',
            'icon' => ':smile:',
            'channel' => 'new_user_registration',
        ],
        'error' => [
            'username' => 'エラー通知',
            'icon' => ':scream:',
            'channel' => 'notice_error',
        ],
        'report' => [
            'username' => '通報',
            'icon' => ':scream:',
            'channel' => 'report',
        ],
    ],
];