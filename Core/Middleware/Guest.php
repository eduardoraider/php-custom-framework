<?php

namespace Core\Middleware;

class Guest
{
    public function handle(): void
    {
        if($_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}