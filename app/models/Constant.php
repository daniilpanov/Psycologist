<?php


namespace app\models;


class Constant extends ModelBothPath
{
    public $name, $key, $value, $translate;

    public function __construct($name)
    {
        $this->setData(db()->query("SELECT * FROM psycologist.constants WHERE name=:id", ['id' => $name])->fetch());
        list($this->key, $this->value) = explode(":", $this->value);
    }

    public function getTable()
    {
        return "constants";
    }
}