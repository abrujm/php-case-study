<?php


namespace App\Http\Controllers;

class BaseApiController extends Controller
{

    private $successStatus = 200;

    /**
     * API Response Wrapper
     *
     * @param bool $status
     * @param string $message
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse(
      $status = true,
      $status_code = 200,
      $message = "",
      array $data = []
    ) {
        $response = [
          'status' => $status ? 'success' : "failure",
          'message' => $message,
          'data' => $data,
        ];
        if (!$status) {
            unset($response['data']);
        }

        return response()->json(['response' => $response], 200);
    }
}
