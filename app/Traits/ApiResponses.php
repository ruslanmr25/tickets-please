<?php



namespace App\Traits;

trait ApiResponses
{



    protected function success($message ="The operation was successful", $data=[], $statusCode = 200)
    {
        return response()->json([
            'meesage' => $message,
            'data' => $data,
            'success' => true
        ], $statusCode);
    }

    protected function error($message, $statusCode)
    {
        return response()->json([
            'meesage' => $message,
            'success' => false
        ], $statusCode);
    }
}
