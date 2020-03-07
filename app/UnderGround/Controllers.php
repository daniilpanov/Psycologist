<?php


namespace app\UnderGround;


class Controllers
{
    private static $instance;

    public static function inst()
    {
        if (!self::$instance)
            self::$instance = new self;

        return self::$instance;
    }

    private $controllers;

    public function __construct()
    {
        $this->controllers = [];
    }

    public function getController($name)
    {
        $name = "app\\controllers\\$name";
        return isset($this->controllers[$name]) ? $this->controllers[$name]
            : ($this->controllers[$name] = new $name());
    }

    public function getControllerByAbsoluteNSC($nsc)
    {
        return isset($this->controllers[$nsc]) ? $this->controllers[$nsc]
            : ($this->controllers[$nsc] = new $nsc());
    }
}