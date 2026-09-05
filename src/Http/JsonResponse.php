<?php
declare(strict_types=1);

namespace AfroVerified\Http;

final class JsonResponse
{
    public static function send($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        exit;
    }

    public static function input(): array
    {
        $type = $_SERVER['CONTENT_TYPE'] ?? '';
        if (strpos($type, 'application/json') !== false) {
            return json_decode(file_get_contents('php://input') ?: '{}', true, 512, JSON_THROW_ON_ERROR);
        }
        return $_POST;
    }
}
