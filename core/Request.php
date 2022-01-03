<?php

namespace app\core;

class Request
{
    protected array $routes = [];

    public function __construct()
    {
        
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        // Проверяем есть ли параметры в запросе
        $params_pos = strpos($path, '?');
        if ($params_pos === false) {
            return $path;
        }
        //echo '<pre>'.var_dump($params_pos).'</pre>';
        return substr($path, 0, $params_pos);
        
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function data()
    {   
        $form_data = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $form_data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $form_data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            
        }
        
        return $form_data;
    }

}