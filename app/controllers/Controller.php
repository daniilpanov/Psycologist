<?php


namespace app\controllers;


use app\UnderGround;

abstract class Controller
{
    /**
     * @return static
     */
    public static function get()
    {
        return UnderGround::getControllerByAbsoluteNSC(static::class);
    }
}