<?php
    return [
        
        'country/<action:(index|update|create|delete)>' => 'country/<action>',

        [
            'pattern' => 'country/<id:\w+>',
            'route' => 'country/view',
            'suffix' => '.asp'
        ],
        'country/<id:\w+>' => 'country/view',

        'site/page/<page:\d+>' => 'site/index',
        'site/index/page/<page:\d+>' => 'site/index',
        // [
        // 'class' => '.....'
        // ]

        // '/' => 'country/index'
    ];