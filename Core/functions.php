<?php

use Core\Response;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

#[NoReturn] function abort($code = 404): void
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN): void
{
    if(!$condition) {
        abort($status);
    }
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view(string $path, array $attributes = [])
{
    extract($attributes);
    return require base_path('views/' . $path);
}

function login($user): void
{
    $_SESSION['user'] = [
        'name' => $user['name'],
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
