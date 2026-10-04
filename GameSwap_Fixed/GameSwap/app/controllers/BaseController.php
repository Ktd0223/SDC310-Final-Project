<?php
declare(strict_types=1);

abstract class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require __DIR__ . '/../views/' . $view . '.php';
        $content = (string) ob_get_clean();
        require __DIR__ . '/../views/layouts/main.php';
    }

    protected function redirect(string $route = ''): void
    {
        $location = 'index.php' . ($route !== '' ? '?route=' . urlencode($route) : '');
        header('Location: ' . $location);
        exit;
    }

    protected function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method not allowed');
        }
    }
}

