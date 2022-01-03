<?php

namespace app\core\exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Страница не найдена';
    protected $code = 404; 
}