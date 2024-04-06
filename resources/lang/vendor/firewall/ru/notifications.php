<?php

return [

    'mail' => [

        'subject' => '🔥 Возможная атака :domain',
        'message' => 'Возможная :middleware атака на :domain была обнаружена с ip :ip адреса. Url на которую была произведена атака: :url',

    ],

    'slack' => [

        'message' => 'Возможная атака на :domain была найдена.',

    ],

];
