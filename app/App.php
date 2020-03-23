<?php


namespace app;


class App
{
    public static $title, $description, $keywords, $id, $display_children;
    public static $show_layout = true;
    public static $layout;

    public static function showLayout()
    {
        require_once "layouts/"
            . self::$layout . ".php";
    }
}