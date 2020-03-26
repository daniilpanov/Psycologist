<?php


namespace app\models\crud;


use app\controllers\ShortCodesController;

class BlogItem extends CRUDModel
{
    public static $start = 0, $limit = 3;

    public $name, $title, $position, $content, $prepared_content,
        $created, $modified, $visible,
        $description, $keywords, $section;

    public function __construct($id = null, $auto_preparing = false)
    {
        if ($id !== null)
        {
            $this->getOne($id);

            if ($auto_preparing)
                $this->prepared_content = ShortCodesController::get()
                    ->getAllCodes()->replace($this->content);
        }
    }

    public function getTable()
    {
        return "blog";
    }
}