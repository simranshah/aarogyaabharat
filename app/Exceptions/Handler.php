<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use ErrorException;
use Illuminate\Database\QueryException;

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
    public function render($request, Throwable $exception) {
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
        return response()->view('error.404', [], 404);
    }

    if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
        return response()->view('error.403', [], 403);
    }

    if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
        return response()->view('error.419', [], 419);
    }

    // if ($exception instanceof \Illuminate\Validation\ValidationException) {
    //     return response()->view('error.422', [], 422);
    // }
    if ($exception instanceof ErrorException || $exception instanceof \Error) {
        return response()->view('error.500', [], 500);
    }
    if ($exception instanceof QueryException) {
        return response()->view('error.503', [], 503);
    }
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
        switch ($exception->getStatusCode()) {
            case 401:
                return response()->view('error.401', [], 401);
            case 403:
                return response()->view('error.403', [], 403);
            case 419:
                return response()->view('error.419', [], 419);
            case 422:
                return response()->view('error.422', [], 422);
            case 500:
                return response()->view('error.500', [], 500);
            case 503:
                return response()->view('error.503', [], 503);
        }
    }

    return parent::render($request, $exception);
}

}
