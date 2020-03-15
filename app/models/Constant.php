<?php


namespace app\models;


class Constant extends ModelBothPath
{
    public $name, $key, $value, $translate;

    public function __construct($name = null)
    {
        if ($name)
        {
            $this->setData(db()->query("SELECT * FROM psycologist.constants WHERE name=:id", ['id' => $name])->fetch());
            list($this->key, $this->value) = explode(":", $this->value);
        }
    }

    public static function aLotOfModels($params, $group, $arguments = [], $cols = "*", $order_by = null, $how = "ASC")
    {
        foreach (
            ($constants = parent::aLotOfModels($params, $group, $arguments, $cols, $order_by, $how)) as $constant
        )
            list($constant->key, $constant->value) = explode(":", $constant->value);

        return $constants;
    }

    public function getTable()
    {
        return "constants";
    }
}