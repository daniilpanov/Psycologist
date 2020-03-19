<?php


namespace app\models;


class Constant extends ModelBothPath
{
    public $name, $key, $value, $translate;

    public function __construct($name = null)
    {
        if ($name)
        {
            $this->setData(db()->query("SELECT * FROM constants WHERE name=:id", ['id' => $name])->fetch());
            if ($this->id)
                list($this->key, $this->value) = explode(":", $this->value);
        }
    }

    public static function aLotOfModels($params, $group, $arguments = [], $cols = "*", $order_by = null, $how = "ASC")
    {
        if ($constants = parent::aLotOfModels($params, $group, $arguments, $cols, $order_by, $how))
        {
            foreach (($constants) as $constant)
                list($constant->key, $constant->value) = explode(":", $constant->value);
        }

        return $constants;
    }

    public function getTable()
    {
        return "constants";
    }
}