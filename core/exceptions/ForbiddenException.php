<?php

namespace app\core\exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'У Вас нет прав на просмотр этой страницы';
    protected $code = 403;
}