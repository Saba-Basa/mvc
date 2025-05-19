<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data);
        require dirname(__DIR__, 2) . "/views/{$template}.php";
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}
