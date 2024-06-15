<?php
namespace App\Traits;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    protected function respondWithMessage(string $message, int $status, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ], $status);
    }

    protected function respondWithError(string $message, int $status): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $status
        ], $status);
    }
}
