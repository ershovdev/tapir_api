<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Response::api(...)
        Response::macro('api', function ($data = [], $message = '', $status = 200, $errors = [], array $headers = [], $options = 0) {
            $body = [
                'result'  => $data ?: new \stdClass(),
                'message' => $message,
                'errors'  => $errors ?: new \stdClass(),
            ];

            return Response::json($body, $status, $headers, $options);
        });
    }
}
