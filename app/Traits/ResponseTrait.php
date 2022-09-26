<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param $data
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    protected function returnResponseError($data, $message, $code)
    {
        $responseData = $this->formatResponseData($data, 'error', $message);
        return response()->json($responseData, $code);
    }


    /**
     * @param $data
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    protected function returnResponseSuccess($data, $message, $code)
    {
        $responseData = $this->formatResponseData($data, 'success', $message);
        return response()->json($responseData, $code);
    }


    /**
     * @param $data
     * @param $status
     * @param $message
     * @return array
     */
    private function formatResponseData($data, $status, $message)
    {
        return [
            'data' => $data,
            'status' => $status,
            'message' => $message
        ];
    }

    /**
     * @param $data
     * @param $message
     * @return mixed
     */
    protected function returnResponseSuccessWithPagination($data, $message)
    {
        return $data->additional([
            'message' => $message,
            'status' => 'success'
        ]);
    }
}
