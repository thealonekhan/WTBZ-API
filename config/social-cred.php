<?php

return [

    'facebook' => [
        'graphUrl' => 'https://graph.facebook.com/',
        'version' => 'v3.3',
        'fields' => ['name', 'email', 'gender', 'verified', 'link'],
    ],

    'google' => [
        'baseUrl' => 'https://oauth2.googleapis.com/tokeninfo'
    ],

];

