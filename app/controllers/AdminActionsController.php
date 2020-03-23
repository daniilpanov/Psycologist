<?php


namespace app\controllers;


use app\App;
use app\UnderGround;

class AdminActionsController extends ActionsController
{
    public function anAction($name, $arguments)
    {
        App::$layout = "admin";
        return true;
    }

    public function __invoke()
    {
        App::$title = "Home";
        $this->view("home");
    }

    public function logout()
    {
        UsersController::get()->logout();
        header("Location: " . ROOT);
    }

    private function view($name, $data = [])
    {
        UnderGround::createModel("ViewDisplay", ["admin/$name", $data]);
    }
}