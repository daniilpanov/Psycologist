<?php


namespace app\controllers;


use app\models\User;

class UsersController extends Controller
{
    private $user = null;

    public function authorizeBySession()
    {
        if (!@$_SESSION['user'])
            return null;

        if (!$user = unserialize($_SESSION['user']))
            return false;

        return ($this->user = User::byToken($user->token))->loginByToken();
    }

    public function authorizeByLP($login, $password)
    {
        $this->user = User::byLoginAndPass($login, $password);
        $_SESSION['user'] = serialize($this->user);

        return $this->user->loginByLP();
    }

    public function logout()
    {
        $_SESSION['user'] = null;
        header("Location: /");
    }

    public function getUser()
    {
        return $this->user;
    }

    public function register()
    {
        $this->user = new User();
    }
}