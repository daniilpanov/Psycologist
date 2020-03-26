<?php


namespace app\controllers;


use app\App;
use app\models\crud\BlogItem;
use app\models\crud\Page;
use app\models\crud\Menu;
use app\UnderGround;

class GuestActionsController extends ActionsController
{
    public function anAction($name, $arguments)
    {
        App::$layout = "guest";
        return true;
    }

    public function __invoke()
    {
        $id = UnderGround::searchModel("constants.Constant",
            ['name' => "home-page"], true);
        $id = (is_object($id) ? $id->value : 1);
        $this->page($id, false);
    }

    public function page($id, $link_error = true)
    {
        //
        UnderGround::addGroup(new UnderGround\ModelGroups("menu"));
        UnderGround::addGroup(new UnderGround\ModelGroups("news"));
        //
        Menu::getAll(
            ['visible' => '1'], "menu", [],
            "id, name, description, position",
            "position"
        );
        //
        Page::getAll(
            [], "menu", [],
            "id, name, position, visible_in, description, parent_id, menu_id, is_link, display_children"
        );
        //
        BlogItem::getAll([], "news", [],
            "id, name, position, description",
            "position, id", "DESC");

        /** @var $page Page */
        $page = UnderGround::createModel("crud\Page", [$id]);

        if ($link_error && (!$page->is_link || $page->is_link == "0"))
        {
            UnderGround::createModel("ViewDisplay", ["guest/error"]);
            return false;
        }

        UnderGround::createModel("ViewDisplay",
            ["guest/page", ["page" => $page]]);

        App::$id = $page->id;
        App::$title = ($page->title ? $page->title : $page->name);
        App::$description = $page->description;
        App::$keywords = $page->keywords;
        App::$display_children = $page->display_children;

        return true;
    }

    public function login()
    {
        UnderGround::createModel("ViewDisplay", ["guest/login"]);
        App::$show_layout = false;

        return true;
    }

    public function auth($data, $type, $_ = null)
    {
        $uc = UsersController::get();

        if ($uc->authorizeByLP($data['login'], $data['password']))
            header("Location: " . ROOT . "admin");
        else
            echo "ERROR!!!";
    }

    public function registration()
    {
        UnderGround::createModel("ViewDisplay", ["guest/registration"]);
        App::$show_layout = false;

        return true;
    }

    public function register($data, $type, $_ = null)
    {
        $uc = UsersController::get();
        if ($uc->register($data['name'], $data['login'], $data['password']))
            header("Location: " . ROOT . "login");
        else
            echo "ERROR!!!";
    }
}