<?php


namespace app\controllers;


abstract class ActionsController extends Controller
{
    public function actionTrigger($for, $arguments)
    {
        if (!method_exists($this, $for))
            return false;

        if (method_exists($this, "anAction"))
            if (!$this->anAction($for, $arguments))
                return false;

        return $this->$for(...$arguments);
    }
}