<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data);
        require __DIR__ . "/../../src/Views/{$template}.php";
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
    // protected function terminate():void{exit;}
}
