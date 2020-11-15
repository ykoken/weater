<?php

return [
    //Carbon was used for token
    'token_lifetimes' => [
        'tokensExpireIn' => now()->addDays(15),
        'refreshTokensExpireIn' => now()->addDays(30),
        'personalAccessTokensExpireIn' => now()->addMonths(6)
    ]

];
