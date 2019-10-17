<?php

namespace App\Exceptions;

use App\Http\Controllers\ApiCommunication;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|\Illuminate\Http\Response|Response
     */
    public function render($request, Exception $exception)
    {


        if ($exception instanceof UnauthorizedHttpException)
            return $this->sendError('Unauthorized', 401);

        if ($exception instanceof AuthorizationException)
            return $this->sendError('Access denied', 403);

        if ($exception instanceof NotFoundHttpException)
            return $this->sendError('Route not found', 404);

        if ($exception instanceof ModelNotFoundException)
            return $this->sendError('Resource not found', 404);

        if ($exception instanceof MethodNotAllowedHttpException)
            return $this->sendError('Method not allowed', 405);

        if ($exception instanceof ValidationException)
            return $this->sendError('Form validation failed', 422, $exception->errors());


        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? $this->sendError('Unauthorized', 401)
            : redirect()->guest($exception->redirectTo() ?? route('web.login.get'));
    }
}
