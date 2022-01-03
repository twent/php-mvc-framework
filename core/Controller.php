<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    // \app\core\middlewares\BaseMiddleware[]
    protected array $middlewares = [];
    public string $layout = 'index';
    public string $action = '';

    public function setlayout($layout)
    {
        $this->layout = $layout;
    } 

    public function render($view, $params = []): string
    {
        return App::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

}