<?php

namespace App\Foundation\Routing;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as LaravelController;

class Controller extends LaravelController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Prepare api response.
     */
    public function formatter(): Formatter
    {
        return Formatter::factory();
    }

    /**
     * Return the api response.
     */
    public function response(array $data = [], int $totCnt = 0, bool $wantInfo = false, int $status = 200): JsonResponse
    {
        return response()->json(Formatter::factory()->make($data, $totCnt, $wantInfo))->setStatusCode($status);
    }

    public function nullResp(): JsonResponse
    {
        $default = $this->formatter()->defaultFormat();

        $default['data'] = null;

        return response()->json($default);
    }

    public function withCustomDataResp(array $data = [], ?string $newDataKey = null, array $newData = []): JsonResponse
    {
        if (empty($newData)) {
            return $this->response($data);
        }

        $default = $this->formatter()->make($data);

        if (! empty($newDataKey)) {
            $default[$newDataKey] = $newData;
        }

        return response()->json($default);
    }

    public function destroyMsg(string $uuid): string
    {
        return "The requested ID: {$uuid} was deleted.";
    }

    /**
     * @param  int  $code
     */
    public function msgResponse($message, $code = 200): JsonResponse
    {
        return response()->json($this->makeMsgResponse($message))->setStatusCode($code);
    }

    /**
     * @param  int  $code
     */
    public function makeMsgResponse($message, $code = 200): array
    {
        return $this->formatter()->setMessage($message)->setStatus($code)->make();
    }
}
