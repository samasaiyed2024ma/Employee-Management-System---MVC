<?php

namespace Ems;

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        include "Views/$view.php";
    }

    /**
     * function to redirect a page
     */
    protected function redirect($route): void
    {
        header("Location: /$route");
        exit();
    }
}
