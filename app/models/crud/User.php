<?php


namespace app\models\crud;


class User extends CRUDModel
{
    public $name, $login, $password;
    public $token, $role;

    public static function byLoginAndPass($login, $password)
    {
        $model = new self();
        $model->login = $login;
        $model->password = password($password);

        return $model;
    }

    public static function byToken($token, $login)
    {
        $model = new self();
        $model->token = $token;
        $model->login = $login;

        return $model;
    }

    public function loginByToken()
    {
        if (($res = db()->query(
            "SELECT * FROM users WHERE token=:t AND login=:l",
            ['t' => $this->token, 'l' => $this->login]
        )) && ($data = $res->fetch()))
        {
            $this->name = $data['name'];
            $this->id = $data['id'];
            $this->login = $data['login'];
            $this->password = $data['password'];
            $this->role = $data['role'];

            return true;
        }
        else
            return null;
    }

    public function loginByLP()
    {
        if (($res = db()->query(
            "SELECT * FROM users WHERE login=:l AND password=:p",
            ['l' => $this->login, 'p' => $this->password]
        )) && ($data = $res->fetch()))
        {
            $this->name = $data['name'];
            $this->id = $data['id'];
            $this->token = $this->generateToken();
            $this->role = $data['role'];

            if (db()->query(
                "UPDATE users SET token=:t WHERE id=:id",
                ['t' => $this->token, 'id' => $this->id]
            ))
                return $this->generateToken();
            else
                return false;
        }
        else
            return null;
    }

    public function generateToken()
    {
        return $this->login . ":" . base64_encode($_SERVER['REMOTE_ADDR'] . ":" . $this->password);
    }

    public function authorized()
    {
        return $this->id && $this->token;
    }

    public function getTable()
    {
        return "users";
    }

    public function logout()
    {
        $this->token = "";
        $this->save();
    }
}