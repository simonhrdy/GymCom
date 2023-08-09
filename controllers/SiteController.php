<?php

namespace app\controllers;

use app\core\Controller;
use app\core\middlewares\AuthMiddleware;


class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function home()
    {
        return $this->render('home');
    }
}
