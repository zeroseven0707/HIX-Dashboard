<?php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

return [

    'api' => [
        // Anda dapat menyesuaikan pengaturan ini sesuai kebutuhan Anda
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'global' => [
        'throttle:global',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => function (Request $request) {
        return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
    },

    // Tambahkan rate limiter lainnya jika diperlukan
];
