<?php

namespace app\core\middlewares;


use app\core\Application;
use app\core\exception\ForbiddenException;


class AuthMiddleware extends BaseMiddleware
{
    protected array $actions = [];
    public string $redirectUrl = '';

    public function __construct()
    {
    }

    public function execute()
    {
        if (Application::isGuest()) {
        } else {
        }
    }
}
