<?php


namespace app\controllers;


use app\UnderGround;

class GuestActionsController extends ActionsController
{
    public function __invoke()
    {
        $id = UnderGround::createModel("constants.Constant", ["home-page"], null, true)->value;
        $page = UnderGround::createModel("Page", [$id]);
        UnderGround::createModel("ViewDisplay", ["home", $page]);
    }

    public function page($id)
    {
        echo $id;
    }
}