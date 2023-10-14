<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException ;

use Illuminate\Http\Request;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AccessDeniedHttpException $e, Request $request) {
     
            if ($request->expectsJson()) {

                return response()->json(['message' => 'You Are Not Authorized To Do This Action.','status' => false],403);
            }
        });
        

        // $this->reportable(function (AuthorizationException $e) {
            
        //     if ($e instanceof AuthorizationException)
        //     {
        //         return response()->json(['error' => 'Not authorized.'],403);
        //     }
        //     return parent::render($request, $e);
        // });
    }
}
