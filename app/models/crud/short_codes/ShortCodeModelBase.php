<?php


namespace app\models\crud\short_codes;


use app\models\crud\CRUDModel;

abstract class ShortCodeModelBase extends CRUDModel
{
    public $code, $replacement, $comment, $type;

    public static function getShortCode($id, $type = "id")
    {
        $data = db()->query("SELECT * FROM short_codes WHERE $type=:$type", [$type => $id])->fetch();
        $object = $data['type'] == "c" ? new ShortCodeModel() : new ShortCodeWithInnerModel();
        $object->setData($data);
        return $object;
    }

    // Метод, возвращающий значение short-code
    abstract public function getReplacement($params = null);

    // Метод замены short-code на его значение
    abstract public function replaceCode($content);

    public function getTable()
    {
        return "short_codes";
    }
}