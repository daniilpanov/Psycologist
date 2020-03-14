<?php


namespace app\models\short_codes;


use app\models\ModelBothPath;

abstract class ShortCodeModelBase extends ModelBothPath
{
    public $code, $replacement, $comment, $type;

    // Метод, возвращающий значение short-code
    abstract public function getReplacement($params = null);

    // Метод замены short-code на его значение
    abstract public function replaceCode($content);

    public function getTable()
    {
        return "short_codes";
    }
}