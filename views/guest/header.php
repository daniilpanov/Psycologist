<?php
use app\App;
use app\models\crud\Page;
use app\UnderGround as UG;

$pages = UG::searchModel("menu.Page", ['visible_in' => ["t", "ts"], 'parent_id' => "0"]);
$home = ROOT;
$logo = UG::searchModel("constants.", ['name' => "big-logo"], true);
$site_name = UG::searchModel("constants.", ['name' => "site-name"], true);

$home_page = new Page();
$home_page->name = is_object($site_name) ? $site_name->value : "Home";

//
function tagA($page, $h)
{
    $id = $page->id;
    $name = $page->name;

    echo "<li class='nav-item"
        . (App::$id == $id
            ? " active" : "")
        . "'>";

    if ($id && $children = UG::searchModel("menu.Page", ['visible_in' => ["t", "ts"], 'parent_id' => $id]))
        dropdownMenu(['parent' => $page, 'submenu' => $children], $h);
    else
    {
        echo ($id === null)
            ? "<a class='nav-link' href='" . $h . "'>$name</a>"
            : "<a class='nav-link' href='{$h}page/id$id'>$name</a>";
        echo "</li>";
    }
}

function dropdownItem($id, $name, $h)
{
    echo "<li><a href='{$h}page/id$id'>$name</a></li>";
}

/**
 * @param $menu Page[]
 * @param $h string
 * @param $first_level bool
 */
function dropdownMenu($menu, $h, $first_level = true)
{
    echo "<li class='nav-item dropdown" . ($first_level ? "" : " dropdown-submenu") . "'>";
    if ($menu['parent']->is_link)
    {
        echo "<a href='{$h}page/id" . $menu['parent']->id . "'>" . $menu['parent']->name . "</a>";
        echo "<a class='dropdown-toggle empty' data-toggle='dropdown'><b class='caret'></b></a>";
    }
    else
        echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>"
            . $menu['parent']->name . "&emsp;<b class='caret'></b></a>";

    echo "<ul class='dropdown-menu'>";

    foreach ($menu['submenu'] as $submenu_item)
    {
        if ($children = UG::searchModel(
                "menu.Page", ['visible_in' => ["t", "ts"], 'parent_id' => $submenu_item->id])
        )
            dropdownMenu(['parent' => $submenu_item, 'submenu' => $children], $h, false);
        else
            dropdownItem($submenu_item->id, $submenu_item->name, $h);
    }

    echo "</ul>";
    echo "</li>";
}

//
if (is_object($logo) && is_file($home . $logo->value))
    echo "<img src=\"$home{$logo->value}\" id=\"big-logo\" alt=\"\">";
?>

<nav class="navbar navbar-expand-md navbar-light" id="top-menu">
    <a class="navbar-brand" href="<?=$home?>"><i><?=$home_page->name?></i></a>

    <button class="navbar-toggler" type="button"
            data-toggle="collapse" data-target="#navbar-content"
            aria-controls="navbar-content" aria-expanded="false"
            aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-content">
        <ul class="navbar-nav mr-auto">
            <?php
            foreach ($pages as $page)
            {
                tagA($page, $home);
                echo "<li class='divider'></li>";
            }
            ?>
        </ul>

        <div class="form-inline my-2 my-lg-0" id="form-sign-in-up">
            <?php
            if (\app\controllers\UsersController::get()->getUser())
                echo "<a href='" . ROOT . "admin'>На страницу админа</a>";
            else
            {
                ?>
                <a class="dt btn btn-outline-success" id="log-in">Войти</a>
                <ul class="dropdown-menu" id="sign-in-up">
                    <li><a target="_blank" href="<?=ROOT?>login">Войти</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a target="_blank" href="<?=ROOT?>reg">Зарегистрироваться</a></li>
                </ul>
                <?php
            }
            ?>

            <!--<button
                type="button" id="log-in"
                class="btn btn-outline-success"
            >
                Войти
            </button>

            <div class="dropdown-menu" id="form-sign-in-up-body">
                <form method="post">
                    <label for="login">Ваш логин</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input name="login" id="login" type="text" class="form-control" placeholder="Username">
                    </div>

                    <label for="login">Ваш пароль</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input name="password" id="login" type="password" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit">Войти</button>
                </form>
                <form method="post">

                </form>
            </div>-->
        </div>
    </div>
</nav>