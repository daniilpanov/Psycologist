<?php


namespace app\controllers;


use app\App;
use app\models\crud\Menu;
use app\models\crud\BlogItem;
use app\models\crud\Page;
use app\models\crud\short_codes\ShortCodeModel;
use app\models\crud\short_codes\ShortCodeModelBase;
use app\models\crud\short_codes\ShortCodeWithInnerModel;
use app\UnderGround;

class AdminActionsController extends ActionsController
{
    public function anAction($name, $arguments)
    {
        App::$layout = "admin";
        return true;
    }

    public function __invoke()
    {
        $this->view("home", "Home");
    }

    public function logout()
    {
        UsersController::get()->logout();
        header("Location: " . ROOT);
    }

    //////////////
    /// СТРАНИЦЫ
    /////////////
    // Список
    public function pages()
    {
        $this->view(
            "list-pages", "Список страниц",
            ['pages' => Page::getAll([], "pages", [], "id, name", "position, id")]
        );
    }
    // Создание / редактирование
    public function createEditPage($id = null)
    {
        $page = ($id === null ? null : new Page($id));
        $this->view(
            "modify-pages", ($id ? "Редактирование" : "Создание") . " страницы",
            [
                'page' => $page,
                'pages' => Page::getAll([], "pages", [], "id, name", "position, id"),
                'menus' => Menu::getAll([], "menus", [], "id, name", "position, id")
            ]
        );
    }
    // Отправка
    public function createEditPageToServer($data, $type, $_ = null)
    {
        $page = new Page();
        $page->setData($data);
        $this->view("result", false,
            ['result' => $page->save(), 'from' => ROOT . "admin/pages"]);
    }
    // Удаление
    public function deletePage($data, $type, $_ = null)
    {
        $this->view("result", false,
            ['result' => (new Page($data['id']))->delete(), 'from' => ROOT . "admin/pages"]);
    }
    //////////////
    /// МЕНЮ
    /////////////
    // Список
    public function menus()
    {
        $this->view(
            "list-menus", "Список страниц",
            ['menus' => Menu::getAll([], "menus", [], "id, name", "position, id")]
        );
    }
    // Создание / редактирование
    public function createEditMenu($id = null)
    {
        $menu = ($id === null ? null : new Menu($id));
        $this->view(
            "modify-menu", ($id ? "Редактирование" : "Создание") . " меню",
            [
                'menu' => $menu,
                'menus' => Menu::getAll([], "menus", [], "id, name, position", "position, id")
            ]
        );
    }
    // Отправка
    public function createEditMenuToServer($data, $type, $_ = null)
    {
        $menu = new Menu();
        $menu->setData($data);
        $this->view("result", false,
            ['result' => $menu->save(), 'from' => ROOT . "admin/menus"]);
    }
    // Удаление
    public function deleteMenu($data, $type, $_ = null)
    {
        $this->view("result", false,
            ['result' => (new Menu($data['id']))->delete(), 'from' => ROOT . "admin/menus"]);
    }
    //////////////
    /// НОВОСТИ
    /////////////
    public function blog()
    {
        $this->view(
            "list-blog", "Список записей",
            ['news' => BlogItem::getAll([], "blog", [], "id, name, description",
                "position, id", "DESC")]
        );
    }
    // Создание / редактирование
    public function createEditBlogItem($id = null)
    {
        $news_item = ($id === null ? null : new BlogItem($id));
        $this->view(
            "modify-blog", ($id ? "Редактирование" : "Создание") . " записи",
            [
                'blog_item' => $news_item,
                'blog' => BlogItem::getAll([], "blog", [], "id, name, position",
                    "position, id", "DESC")
            ]
        );
    }
    // Отправка
    public function createEditBlogItemToServer($data, $type, $_ = null)
    {
        $news = new BlogItem();
        $news->setData($data);
        $this->view("result", false,
            ['result' => $news->save(), 'from' => ROOT . "admin/blog"]);
    }
    // Удаление
    public function deleteBlogItem($data, $type, $_ = null)
    {
        $this->view("result", false,
            ['result' => (new BlogItem($data['id']))->delete(), 'from' => ROOT . "admin/blog"]);
    }
    //////////////
    /// SHORT_CODES
    /////////////
    public function shortCodes()
    {
        $this->view(
            "list-short_codes", "Список шорткодов",
            ['short_codes' => array_merge(
                (array) ShortCodeModel::getAll(['type' => "c"],
                    "short_codes", [], "id, code, comment, type"),
                (array) ShortCodeWithInnerModel::getAll(['type' => "d"],
                    "short_codes", [], "id, code, comment, type")
            )]
        );
    }
    // Создание / редактирование
    public function createEditShortCode($id = null)
    {
        $short_code = ($id === null ? null : ShortCodeModelBase::getShortCode($id));
        $this->view(
            "modify-short_codes", ($id ? "Редактирование" : "Создание") . " шорткода",
            ['short_code' => $short_code]
        );
    }
    // Отправка
    public function createEditShortCodeToServer($data, $type, $_ = null)
    {
        $short_code = ($data['type'] == "c"
            ? new ShortCodeModel()
            : new ShortCodeWithInnerModel());
        $short_code->setData($data);
        $this->view("result", false,
            ['result' => $short_code->save(false), 'from' => ROOT . "admin/short_codes"]);
    }
    // Удаление
    public function deleteShortCode($data, $type, $_ = null)
    {
        $this->view("result", false,
            ['result' => (ShortCodeModelBase::getShortCode($data['id']))->delete(),
                'from' => ROOT . "admin/short_codes"]);
    }
}