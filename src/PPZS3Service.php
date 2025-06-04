<?php

namespace PPZ\S3Service;

use Illuminate\Support\Facades\Http;

class PPZS3Service
{
    public static function upload(array $params)
    {
        $endpoint = config('s3service.endpoint', env('PPZ_S3_UPLOAD_ENDPOINT'));
        $apiKey = config('s3service.api_key', env('PPZ_API_KEY'));

        $file = $params['file'];
        unset($params['file']);

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
        ])->attach(
            'file', fopen($file->getRealPath(), 'r'), $file->getClientOriginalName()
        )->post($endpoint, $params);

        return $response->json();
    }
}