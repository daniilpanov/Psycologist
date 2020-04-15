<?php


namespace app\controllers;


use app\App;
use app\models\crud\Constant;
use app\models\crud\Menu;
use app\models\crud\BlogItem;
use app\models\crud\Page;
use app\models\crud\Review;
use app\models\crud\short_codes\ShortCodeModel;
use app\models\crud\short_codes\ShortCodeModelBase;
use app\models\crud\short_codes\ShortCodeWithInnerModel;
use app\models\crud\User;

class AdminActionsController extends ActionsController
{
    public function anAction($name, $arguments)
    {
        App::$layout = UsersController::get()->getUser()->role;
        return true;
    }

    public function __invoke()
    {
        $this->view("home", "Home", [], UsersController::get()->getUser()->role);
    }

    public function logout($goto = null)
    {
        UsersController::get()->logout(false);
        header("Location: " . ROOT
            . (is_string($goto) ? $goto : ""));
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
                'pages' => Page::getAll([], "pages", [], "id, name, position", "position, id"),
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
    /// БЛОГ
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
    //////////////
    /// USERS
    /////////////
    public function users()
    {
        $this->view(
            "list-users", "Список пользователей",
            ['users' => (array) User::getAll([], "users", [], "id, name, login")]
        );
    }
    // Создание / Редактирование
    public function createEditUser($id = null)
    {
        if ($id)
        {
            $user = new User();
            $user->getOne($id);

            $this->view(
                "modify-user", "Редактирование пользователя", ['user' => $user]
            );
        }
        else
            $this->view(
                "modify-user", "Создание пользователя", ['user' => null]
            );
    }
    // Отправка
    public function createUserToServer($data, $type, $_ = null)
    {
        $user = new User();
        $user->setData($data);
        $user->password = password($user->password);

        $this->view("result", false,
            ['result' => $user->save(false), 'from' => null]);
    }
    public function editUserToServer($data, $type, $_ = null)
    {
        //
        $user = new User();
        $user->getOne($data['id']);

        //
        if (($old_pass = password($data['check_password'])) != $user->password)
        {
            $this->view('result', "Ошибка!",
            ['result' => false, 'from' => ROOT . "admin/users",
                'spec_msg' => "Вы неправильно ввели пароль!"]);
            return ;
        }

        //
        $data['password'] = ($data['new_password'] ? password($data['new_password']) : $old_pass);
        unset($data['check_password'], $data['new_password']);
        //
        if ($user->id == UsersController::get()->getUser()->id)
            $data['role'] = UsersController::get()->getUser()->role;
        //
        $user->setData($data);
        //
        $res = $user->save(false);
        //
        $this->view("result", false,
            ['result' => $res, 'from' => null]);
        //
        if ($res && $user->id == UsersController::get()->getUser()->id)
            $this->logout("login");
    }
    // Удаление
    public function deleteUser($data, $type, $_ = null)
    {
        $user = new User();
        $user->id = $data['id'];

        if (UsersController::get()->getUser()->id == $user->id)
        {
            $this->view("result", false,
                ['result' => false, 'from' => ROOT . "admin/users",
                    'spec_msg' => "Вы не можете удалить пользователя, под которым зашли!"]);
            return ;
        }

        $this->view("result", false,
            ['result' => $user->delete(), 'from' => ROOT . "admin/users"]);
    }
    //////////////
    /// REVIEWS
    /////////////
    public function reviews()
    {
        /** @var $reviews Review[] */
        $reviews = Review::getForAdmin(
            null, "id, title, user_id, user, page_id, rating",
            "reviews",
            (UsersController::get()->getUser()->role != "commentator" ? null
                : ['user_id' => UsersController::get()->getUser()->id])
        );

        $this->view(
            "list-reviews", "Список отзывов",
            ['reviews' => $reviews]
        );
    }
    // Создание / Редактирование
    public function createEditReview($id = null)
    {
        $pages = Page::getAll([], "pages", [], "id, name", "position");
        if ($id)
        {
            $review = Review::getForAdmin($id);
            $this->view(
                "modify-review", "Редактирование отзыва", ['review' => $review, 'pages' => $pages]
            );
        }
        else
            $this->view(
                "modify-review", "Создание отзыва", ['review' => null, 'pages' => $pages]
            );
    }
    // Отправка
    public function createEditReviewToServer($data, $type, $_ = null)
    {
        //
        if (isset($data['id']))
            $review = new Review($data['id']);
        else
        {
            $review = new Review();
            $review->user_id =
                UsersController::get()->getUser()->id;
        }

        $review->setData($data);
        //
        $this->view("result", false,
            ['result' => $review->save(), 'from' => null]);
    }
    // Удаление
    public function deleteReview($data, $type, $_ = null)
    {
        $review = new Review();
        $review->id = $data['id'];

        $this->view("result", false,
            ['result' => $review->delete(), 'from' => ROOT . "admin/reviews"]);
    }
    //////////////
    /// CONSTANTS
    /////////////
    public function constants()
    {
        /** @var $constants Constant[] */
        $constants = Constant::getAll([], "constants", []);

        $this->view(
            "list-constants", "Настройки",
            ['constants' => $constants]
        );
    }
    // Создание / Редактирование
    public function createEditConstant($id = null)
    {
        if ($id)
        {
            $constant = new Constant();
            $constant->getOne($id);
            $constant->prepare();

            $this->view(
                "modify-constants", "Изменение настройки", ['constant' => $constant]
            );
        }

        $this->view(
            "modify-constants", "Создание настройки", ['constant' => null]
        );
    }
    // Отправка
    public function createEditConstantToServer($data, $type, $_ = null)
    {
        //
        $constant = new Constant();
        $constant->setData($data);
        //
        $this->view("result", false,
            ['result' => $constant->save(), 'from' => ROOT . "admin/constants"]);
    }
    // Удаление
    public function deleteConstant($data, $type, $_ = null)
    {
        $constant = new Constant();
        $constant->id = $data['id'];

        $this->view("result", false,
            ['result' => $constant->delete(), 'from' => ROOT . "admin/constants"]);
    }
}