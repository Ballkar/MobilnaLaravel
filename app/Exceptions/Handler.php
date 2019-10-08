<?php

namespace App\Exceptions;

use App\Http\Controllers\ApiCommunication;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    use ApiCommunication;

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
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException)
            return $this->sendError('Route not Found', 404);

        if ($exception instanceof ValidationException)
            return $this->sendError('Form validation failed', 422, $exception->errors());

        if ($exception instanceof ModelNotFoundException)
            return $this->sendError('Not found', 404);

        if ($exception instanceof AuthorizationException)
            return $this->sendError('You are not auth', 403);

        if ($exception instanceof MethodNotAllowedHttpException)
            return $this->sendError('Method not allowed', 405);

        if ($exception instanceof UnauthorizedHttpException)
            return $this->sendError('Unauthorized', 401);

        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|\Illuminate\Http\Response|Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return $this->sendError('Resource not found', 404);
        }

        return parent::render($request, $exception);
    }
}
