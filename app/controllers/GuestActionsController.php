<?php


namespace app\controllers;


use app\App;
use app\models\Page;
use app\UnderGround;

class GuestActionsController extends ActionsController
{
    public function __invoke()
    {
        $id = UnderGround::createModel("constants.Constant", ["home-page"], null, true)->value;
        $this->page($id);
    }

    public function page($id)
    {
        /** @var $page Page */
        $page = UnderGround::createModel("Page", [$id]);

        if (!$page->is_link || $page->is_link == "0")
        {
            UnderGround::createModel("ViewDisplay", ["guest/error"]);
            return false;
        }

        UnderGround::createModel("ViewDisplay", ["guest/page", ["page" => $page]]);

        App::$id = $page->id;
        App::$title = $page->title;
        App::$description = $page->description;
        App::$keywords = $page->keywords;

        return true;
    }
}