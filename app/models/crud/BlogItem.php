<?php


namespace app\models\crud;


class BlogItem extends CRUDModel
{
    public static $start = 0, $limit = 3;

    public $name, $position, $content, $prepared_content,
        $created, $modified, $visible,
        $description, $keywords, $section;

    public function __construct($id = null)
    {
        if ($id !== null)
            $this->getOne($id);
    }

    public function getTable()
    {
        return "blog";
    }
}