<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (env('APP_DEBUG')) {
            return parent::render($request, $exception);
        }

        $message = self::message($exception);

        return response()->json([
            'status' => 'error',
            'message' => $message[1],
        ], $message[0]);
    }

    /**
     * A list error messages
     *
     * @var array
     */
    protected function message(Throwable $exception): array
    {
        switch (get_class($exception)) {
            case 'Illuminate\Auth\Access\AuthorizationException':
                return [401, 'Not authorized'];

            case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
            case 'Illuminate\Database\Eloquent\ModelNotFoundException':
                return [404, 'Page not found'];

            default:
                return [500, 'Server error'];
                break;
        }
    }
}
