<?php


namespace app\controllers;


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
}