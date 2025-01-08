<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    /**
     * Rollback transaction and throw an exception with a custom message.
     *
     * @param \Exception $e
     * @param string $message
     */
    public static function rollback($e, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    /**
     * Throw an exception and log the error message.
     *
     * @param \Exception $e
     * @param string $message
     */
    public static function throw($e, $message = "Something went wrong! Process not completed")
    {
        Log::error($e);
        throw new HttpResponseException(response()->json([
            "status" => "error",
            "message" => $message
        ], 500));
    }

    /**
     * Send a successful response with data and an optional message.
     *
     * @param mixed $result
     * @param string|null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendResponse($status, $result, $message = null, $code = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data'    => $result
        ];
        return response()->json($response, $code);
    }

    /**
     * Send a paginated response with data and pagination info.
     *
     * @param mixed $result
     * @param array $pagination
     * @param string|null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendPaginatedResponse($status, $result, $pagination, $title = 'items', $message = null, $code = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => [
                $title => $result,
            ],
            'pagination' => $pagination,
        ];

        return response()->json($response, $code);
    }
}
