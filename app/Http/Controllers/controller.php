<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController; // Extending Laravel's base controller

abstract class Controller extends BaseController
{
    /**
     * Common method to handle API responses.
     *
     * @param  mixed  $data
     * @param  int  $status
     * @return JsonResponse
     */
    protected function sendResponse($data, $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $data
        ], $status);
    }

    /**
     * Common method to handle error responses.
     *
     * @param  string  $message
     * @param  int  $status
     * @return JsonResponse
     */
    protected function sendError(string $message, int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }

    /**
     * A method to log specific events or errors (for debugging).
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    protected function logEvent(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    /**
     * An abstract method that child classes must implement.
     * This can be used for custom behavior in child controllers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    abstract public function handleRequest(Request $request): JsonResponse;
}
