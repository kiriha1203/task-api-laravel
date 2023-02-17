<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     * 
     * APIエラーの場合、apiErrorResponse をcall
     * Webエラーの場合、ここで完結
     */
    public function render(Request $request, Exception $e)
    {
        if ($request->('api/*')) {
            return $this->apiErrorResponse($request, $e);
        }

        return parent::render($request, $e);
    }

    private function apiErrorResponse(Request $request, Exception $e)
    {
        $e = $this->prepareException($e);
        if($e instanceof HttpRequestException) {
            return $e->getResponse();
        } elseif ($e instanceof ValidationException) {
            $status = $e->status;
            $message = Response::$statusTexts[$status];
            $errors = $e->errors();
        } elseif ($e instanceof isHttpException($e)) {
            $status = $e->getStatusCode();
            $message = (isset(Response::$statusTexts[$status])) ? Response::$statusTexts[$status] : '';
            $errors = [];
        } else {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Server Error';
            $errors = [];
        }

        // ResponseApiServerProviderが実行される前にエラーが発生した時
        if (! method_exists(response(), 'error')) {
            $app = app();
            $provide = new ResponseApiServiceProvider($app);
            $provide->boot();
        }

        return response()->error($message, $error, $status);
    }
}
