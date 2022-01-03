<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    CONST STATUS_INACTIVE = 0;
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_DELETED = 2;
    
    public int $id = 0;
    public string $name = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_ACTIVE;
    public string $password = '';
    public string $password_repeat = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['name', 'lastname', 'email', 'status', 'password'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Имя',
            'lastname' => 'Фамилия',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Подтверждение пароля'
        ];
    }

    public function fullName(): string
    {
        return $this->name.' '.$this->lastname;
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '8']],
            'password_repeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function getDisplayName(): string
    {
        return $this->name . ' ' . $this->lastname;
    }

} 