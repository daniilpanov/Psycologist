<?php


namespace app\models\crud;


class Menu extends CRUDModel
{
    public $name, $position,
        $created, $modified,
        $description, $keywords;

    public function __construct($id = null)
    {
        if ($id)
            $this->getOne($id);
    }

    public function getTable()
    {
        return "menu";
    }
}