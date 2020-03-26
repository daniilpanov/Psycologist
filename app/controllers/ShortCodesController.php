<?php


namespace app\controllers;


use app\models\crud\short_codes\ShortCodeModel;
use app\models\crud\short_codes\ShortCodeWithInnerModel;
use app\UnderGround;

class ShortCodesController extends Controller
{
    private $short_codes, $short_codes_with_inner;

    public function getAllCodes()
    {
        if (!UnderGround::getGroup("short_codes"))
            UnderGround::addGroup(new UnderGround\ModelGroups("short_codes"));
        $this->short_codes = ShortCodeModel::getAll(['type' => 'c'], "short_codes");
        $this->short_codes_with_inner = ShortCodeWithInnerModel::getAll(['type' => 'd'], "short_codes");

        return $this;
    }

    public function replace($content)
    {
        if ($this->short_codes)
        {
            foreach ($this->short_codes as $short_code)
                $content = $short_code->replaceCode($content);
        }

        if ($this->short_codes_with_inner)
        {
            foreach ($this->short_codes_with_inner as $short_code)
                $content = $short_code->replaceCode($content);
        }

        return $content;
    }
}