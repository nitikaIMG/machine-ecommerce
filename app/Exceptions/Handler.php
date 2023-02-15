<?php

namespace App\Exceptions;

use App\Services\Api\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, $exception)
    {
        if( $this->shouldReturnJson($request, $exception) ) {

            $data = [];
            $message = $exception->getMessage();

            if( $exception instanceof AuthenticationException ) {
                $data['requires_login'] = 1;
                return ApiResponse::session_expired($message, $data);
            }

            else if( $exception instanceof ValidationException ) {
                $message = $exception->validator->getMessageBag()->first();
                return ApiResponse::validation($message, $data);
            }

            else if( $exception instanceof RecordsNotFoundException ) {
                return ApiResponse::notFound(__('Resource not found'), $data);
            }

            else if( $exception instanceof AuthorizationException ) {
                return ApiResponse::forbidden($message, $data);
            }

            else if( $exception instanceof UnauthorizedException ) {
                return ApiResponse::forbidden(__('Unauthorized access'), $data);
            }

            else if( $exception instanceof NotFoundHttpException ) {
                return ApiResponse::notFound(__('Resource not found'));
            }

            $message = !empty($message) ? $message : __('Something went wrong');

            return ApiResponse::error($message, $data);
        }

        return parent::render($request, $exception);
    }
}
