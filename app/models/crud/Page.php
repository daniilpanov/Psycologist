<?php


namespace app\models\crud;


use app\controllers\ShortCodesController;

class Page extends CRUDModel
{
    public $name, $title, $position,
        $content, $created, $modified, $prepared_content,
        $visible_in, $is_link,
        $description, $keywords,
        $parent_id, $menu_id, $section_id, $display_children;

    public function __construct($id = null, $auto_preparing = true)
    {
        if ($id)
        {
            $this->getOne($id);

            if ($auto_preparing)
                $this->prepareContent();
        }
    }

    public function prepareContent()
    {
        if ($this->content)
            $this->prepared_content = ShortCodesController::get()->getAllCodes()->replace($this->content);
    }

    public function getTable()
    {
        return "pages";
    }
}