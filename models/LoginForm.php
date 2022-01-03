<?php

namespace app\models;

use twent\mvccore\App;
use twent\mvccore\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'Пользователь с таким email не существует');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Неверный пароль');
            return false;
        }

        return App::$app->login($user);
    }

}
