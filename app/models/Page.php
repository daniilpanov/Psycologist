<?php


namespace app\models;


class Page extends ModelBothPath
{
    public $name, $position,
        $content, $created, $modified,
        $visible_in, $is_link,
        $description, $keywords,
        $parent_id, $menu_id, $section_id;

    public function __construct($id)
    {

    }

    public static function getPages($params, $group, $arguments = [], $cols = "*")
    {
        return parent::aLotOfModels($params, $group, $arguments, $cols, "position");
    }

    public function getTable()
    {
        return "pages";
    }
}