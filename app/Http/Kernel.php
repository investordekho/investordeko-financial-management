<?php

protected $routeMiddleware = [
    // Other middleware
    'verified.user' => \App\Http\Middleware\CheckVerifiedUser::class,
];
