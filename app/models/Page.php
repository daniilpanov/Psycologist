<?php


namespace app\models;


use app\controllers\ShortCodesController;

class Page extends ModelBothPath
{
    public $name, $title, $position,
        $content, $created, $modified,
        $visible_in, $is_link,
        $description, $keywords,
        $parent_id, $menu_id, $section_id, $display_children;

    public function __construct($id = null)
    {
        if ($id)
        {
            $this->setData(db()->query("SELECT * FROM pages WHERE id=:id", ['id' => $id])->fetch());

            if ($this->content)
                $this->content = ShortCodesController::get()->getAllCodes()->replace($this->content);
        }
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