<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionsHandler
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render($request, Throwable $e): Response
    {
        $response = parent::render($request, $e);
        $status = $response->status();

        return match($status) {
            404 => Inertia::render('Errors/404')->toResponse($request)->setStatusCode($status),
            503 => Inertia::render('Errors/503')->toResponse($request)->setStatusCode($status),
            default => $response
        };
    }
}
