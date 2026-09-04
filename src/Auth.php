<?php
declare(strict_types=1);

namespace AfroVerified;

use AfroVerified\Http\JsonResponse;

final class Auth
{
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $sessionPath = dirname(__DIR__) . '/storage/sessions';
            if (!is_dir($sessionPath)) mkdir($sessionPath, 0775, true);
            session_save_path($sessionPath);
            session_name('afroverified_admin');
            session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS'])]);
            session_start();
        }
    }

    public static function login(string $email, string $password): ?array
    {
        $user = Database::connection()->fetchAssociative('SELECT id, name, email, password_hash, role, status FROM users WHERE email = ?', [$email]);
        if (!$user || $user['status'] !== 'active' || !in_array($user['role'], ['admin', 'administrator'], true) || !password_verify($password, $user['password_hash'])) return null;
        self::start(); session_regenerate_id(true); $_SESSION['user_id'] = (int) $user['id'];
        unset($user['password_hash']); return $user;
    }

    public static function user(): ?array
    {
        self::start();
        if (empty($_SESSION['user_id'])) return null;
        return Database::connection()->fetchAssociative('SELECT id, name, email, role, status FROM users WHERE id = ?', [$_SESSION['user_id']]) ?: null;
    }

    public static function requireAdmin(): array
    {
        $user = self::user();
        if (!$user || !in_array($user['role'], ['admin', 'administrator'], true)) JsonResponse::send(['error' => 'Authentication required'], 401);
        return $user;
    }

    public static function csrfToken(): string
    {
        self::start();
        return $_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));
    }

    public static function requireCsrf(): void
    {
        $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (!hash_equals(self::csrfToken(), $token)) JsonResponse::send(['error' => 'Invalid CSRF token'], 419);
    }
}
