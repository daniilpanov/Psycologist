<?php


namespace app\controllers;


use app\App;
use app\UnderGround;

abstract class ActionsController extends Controller
{
    public function actionTrigger($for, $arguments)
    {
        if ($for)
        {
            if (!method_exists($this, $for))
                return false;

            if (method_exists($this, "anAction"))
                if (!$this->anAction($for, $arguments))
                    return false;

            return $this->$for(...$arguments);
        }
        else
        {
            if (!method_exists($this, "__invoke"))
                return false;

            if (method_exists($this, "anAction"))
                if (!$this->anAction("__invoke", $arguments))
                    return false;

            return $this(...$arguments);
        }
    }

    protected function view($name, $title = false, $data = [], $for = "admin")
    {
        App::$title = ($title !== false ? $title : App::$title);
        UnderGround::createModel("ViewDisplay", ["$for/$name", $data]);
    }
}