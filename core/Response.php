<?php

namespace app\core;

class Response
{
    public function setStatusCode(int $code)
    {
        return http_response_code($code);
    }

    public function redirect(string $url_path)
    {
        header('Location:' . $url_path);
    }

}