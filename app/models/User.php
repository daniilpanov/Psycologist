<?php


namespace app\models;


class User extends ModelBothPath
{
    public $name, $login, $password;
    public $token;

    public static function byLoginAndPass($login, $password)
    {
        $model = new self();
        $model->login = $login;
        $model->password = password($password);

        return $model;
    }

    public static function byToken($token)
    {
        $model = new self();
        $model->token = $token;

        return $model;
    }

    public function loginByToken()
    {
        if (($res = db()->query(
            "SELECT * FROM psycologist.users WHERE token=:t",
            ['t' => $this->token]
        )) && ($data = $res->fetch()))
        {
            $this->name = $data['name'];
            $this->id = $data['id'];
            $this->login = $data['login'];
            $this->password = $data['password'];

            return true;
        }
        else
            return null;
    }

    public function loginByLP()
    {
        if (($res = db()->query(
            "SELECT * FROM psycologist.users WHERE login=:l AND password=:p",
            ['l' => $this->login, 'p' => $this->password]
        )) && ($data = $res->fetch()))
        {
            $this->name = $data['name'];
            $this->id = $data['id'];
            $this->token = $this->generateToken();

            if (db()->query(
                "UPDATE psycologist.users SET token=:t WHERE id=:id",
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
}