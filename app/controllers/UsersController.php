<?php


namespace app\controllers;


use app\models\crud\User;

class UsersController extends Controller
{
    private $user = null;

    public function authorizeBySession()
    {
        if (!@$_SESSION['user'])
            return null;

        if (!$user = unserialize($_SESSION['user']))
            return false;

        if (($this->user = User::byToken($user->token, $user->login))->loginByToken())
            return true;
        else
        {
            $this->logout(false);
            return null;
        }
    }

    public function authorizeByLP($login, $password)
    {
        $this->user = User::byLoginAndPass($login, $password);
        if ($res = $this->user->loginByLP())
            $_SESSION['user'] = serialize($this->user);
        else
            $this->user = $_SESSION['user'] = null;

        return $res;
    }

    public function logout($locate = true)
    {
        $this->user->logout();
        $_SESSION['user'] = null;
        if ($locate)
            header("Location: " . ROOT);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function register($name, $login, $password)
    {
        $user = $this->user = new User();

        $user->name = $name;
        $user->login = $login;
        $user->password = password($password);
        $user->token = "";

        return $user->save();
    }
}