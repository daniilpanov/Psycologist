<?php


namespace app\models;


class Menu extends ModelBothPath
{
    public $name, $position,
        $created, $modified,
        $description, $keywords,
        $visible_in;

    public function __construct($id = null)
    {
        if ($id)
        {
            $this->setData(
                db()->query("SELECT * FROM menu WHERE id=:id", ['id' => $id])
                    ->fetch()
            );
        }
    }

    public function getTable()
    {
        return "menu";
    }
}