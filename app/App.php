<?php


namespace app;


class App
{
    public static $title, $description, $keywords, $id;

    public static function showLayout()
    {
        require_once "layouts/"
            . (\app\controllers\UsersController::get()->getUser()
                ? "admin" : "guest") . ".php";
    }
}