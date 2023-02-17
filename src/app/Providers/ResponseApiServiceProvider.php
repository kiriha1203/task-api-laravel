<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

/**
 * Response (API)
 * @package App\Providers
 */
class ResponseApiServiceProvider extends ServiceProvider
{
  /**
   * アプリケーションのレスポンスマクロ登録
   * 
   * @return void
   */
  public function boot()
  {
    // Success (200 OK.)
    Response::macro('success', function ($data) {
      return response()->json([
        'response' => $data
      ]);
    });

    // Error (4xx, 5xx)
    Response::macro('error', function ($message, array $errors = [], $status = ResponseStatus::HTTP_INTERNAL_SERVER_ERROR) {
      return response()->json([
        'message' => $message,
        'errors' => (object) $errors
        'code' => $status,
      ], $status);
    });
  }
}
