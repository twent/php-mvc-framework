<?php

namespace app\models;

use app\core\App;
use app\core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $text = '';

    public function rules()
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'text' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'subject' => 'Тема сообщения',
            'email' => 'Ваш Email',
            'text' => 'Сообщение'
        ];
    }

    public function send()
    {
        // Логика отпраки контактной формы
        return true;
    }
    
}
