<?php

namespace App\Exceptions;

use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {

            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'message' => 'Unauthenticated.',
                    'http_response' => 401,
                    'status_code' => 0 ,
                ], 401);
            }

            if ($exception instanceof BodyTooLargeException) {
                return response()->json([
                    'message' => 'The body is too large',
                    'http_response' => 413,
                    'status_code' => 0,
                ], 413);
            }
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => $exception->getMessage(),
                    'http_response' => 422,
                    'status_code' => 0,
                    'errors' => $exception->errors(),
                ], 422);
            }
            if ($exception instanceof StoreResourceFailedException) {
                return response()->json([
                    'message' => $exception->getMessage(),
                    'http_response' => 422,
                    'status_code' => 0,
                    'errors' => $exception->errors,
                ], 422);
            }
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => '404 Not Found',
                    'http_response' => 404,
                    'status_code' => 0,
                    'errors' => $exception->getMessage(),

                ], 404);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'message' => '405 Method not allowed',
                    'http_response' => 405,
                    'status_code' => 0,
                ], 405);
            }

            if ($exception instanceof QueryException) {
                return response()->json([
                    'message' => '422 Unprocessable Entity',
                    'error' => $exception->getMessage(),
                    'http_response' => 422,
                    'status_code' => 0,
                ], 405);
            }

            return parent::render($request, $exception);

            return response()->json([
                'message' => '500 , An Error has Occured',
                'http_response' => 500,
                'status_code' => 0,
            ], 404);
        } else {
            return parent::render($request, $exception);
        }
    }
}
