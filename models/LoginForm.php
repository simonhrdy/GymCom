<?php

namespace app\models;


use app\core\Application;
use app\core\Model;


class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Váš email',
            'password' => 'Váše heslo'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', '');
            return false;
        }
        if (!password_verify($this->password, $user->heslo)) {
            $this->addError('password', 'Špatné heslo');
            return false;
        }
        if (!$user->is_active()) {
            $this->addError('password', 'Tento účet není aktivní');
            return false;
        }

        return Application::$app->login($user);
    }
}
