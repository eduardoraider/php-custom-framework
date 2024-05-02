<?php

namespace Core\Middleware;
class Auth
{
    public function handle(): void
    {
        if(!isset($_SESSION['user']) || !$_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }

}