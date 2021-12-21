<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Helper\Apibuilder as Api;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof MethodNotAllowedHttpException) {
            $code = 405;
            $message = "Method Not Allowed";
            $response = [];
            return Api::apiRespond($code, $response, $message);
        } else if ($e instanceof ModelNotFoundException) {
            return Api::apiRespond(404, [], "Data Not Found");
        } else if ($e instanceof NotFoundHttpException) {
            $code = 404;
            $message = "Endpoint Not Found";
            $response = [];
            return Api::apiRespond($code, $response, $message);
        }

        return parent::render($request, $e);
    }
}