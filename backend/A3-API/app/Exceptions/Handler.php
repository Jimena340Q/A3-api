<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Monolog\Handler\IFTTTHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    private $url = ['career', 'course', 'environment_type', 'instructor', 'learning_environment', 'location', 'scheduling_environment' ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        //
    }

    public function render($request, Throwable $exception)
    {
         if($exception instanceof AuthorizationException)
         {
             return response()->json([
                 'message' => 'Acceso prohibido al recurso'
             ], Response::HTTP_FORBIDDEN);
         }
     
         if($exception instanceof RouteNotFoundException)
         {
             return response()->json([
                 'message' => 'Debe iniciar sesion'
             ], Response::HTTP_UNAUTHORIZED);
         }
     
         return parent::render($request, $exception);
    }
}


   

