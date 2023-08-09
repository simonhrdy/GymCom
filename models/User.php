<?php


namespace app\models;


use app\core\db\DbModel;
use app\core\UserModel;


class User extends UserModel
{
    public int $idUzivatele = 0;
    public string $email = '';
    public string $heslo = '';
    public string $jmeno = '';
    public string $prijmeni = '';
    public int $uzRole_idRole = 0;
    public int $aktivni = 0;

    public static function primaryKey(): string
    {
        return 'idUzivatele';
    }
    public static function tableName(): string
    {
        return 'uzivatele';
    }

    public function attributes(): array
    {
        return ['idUzivatele', 'email', 'heslo', 'jmeno', 'prijmeni', 'uzRole_idRole', 'aktivni'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'Jméno',
            'lastname' => 'Přijmení',
            'email' => 'Email',
            'password' => 'Heslo',
            'passwordConfirm' => 'Heslo znovu'
        ];
    }

    public function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->heslo = password_hash($this->heslo, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function is_admin()
    {
        return $this->uzRole_idRole === 0;
    }

    public function is_active()
    {
        return $this->aktivni === 1;
    }

    public function getDisplayName(): string
    {
        return $this->jmeno . ' ' . $this->prijmeni;
    }
}
