<?php


namespace app\models\crud;


class Constant extends CRUDModel
{
    public $name, $key, $value, $translate;

    public function __construct($name = null)
    {
        if ($name)
        {
            $this->setData(db()->query("SELECT * FROM constants WHERE name=:id", ['id' => $name])->fetch());
            $this->prepare();
        }
    }

    public function prepare()
    {
        if ($this->id)
            list($this->key, $this->value) = explode(":", $this->value);
    }

    public static function getAll($params, $group, $arguments = [], $cols = "*", $order_by = null, $how = "ASC")
    {
        if ($constants = parent::getAll($params, $group, $arguments, $cols, $order_by, $how))
        {
            foreach (($constants) as $constant)
                list($constant->key, $constant->value) = explode(":", $constant->value);
        }

        return $constants;
    }

    public function save($timestamp = true)
    {
        $this->value = $this->key . ":" . $this->value;
        unset($this->key);
        $res = parent::save(false);
        $this->prepare();
        return $res;
    }

    public function getTable()
    {
        return "constants";
    }
}