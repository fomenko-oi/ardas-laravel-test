<?php

namespace App\Http\Actions;

trait ApiResponsesTrait
{
    public function success($data = []): array
    {
        return ['success' => true, 'data' => $data];
    }

    public function error(string $message, $data = null)
    {
        return ['success' => false, 'error' => $message, 'data' => $data];
    }
}
