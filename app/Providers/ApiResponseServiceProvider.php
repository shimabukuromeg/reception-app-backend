<?php

namespace App\Providers;

use Illuminate\Http\Response as ResponseStatus;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

/**
 * Class ApiResponseServiceProvider
 * @package App\Providers
 */
class ApiResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('apiError', function ($message, $status = ResponseStatus::HTTP_BAD_REQUEST) {
            return response()->json([
                'message' => $message,
            ], $status);
        });
    }
}
