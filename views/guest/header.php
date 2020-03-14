<?php
use app\App;
use app\UnderGround as UG;

$pages = UG::searchModel("menu.Page", ['visible_in' => ["s", "ts"], 'parent_id' => "0"]);

$home = UG::searchModel("constants.", ['name' => "root-path"], true);
$home = (is_object($home) ? $home->value : "/");

//
function tagA($page, $h)
{
    $id = $page->id;
    $name = $page->name;

    echo "<li class='nav-item"
        . (App::$id == $id
            ? " active" : "")
        . "'>";

    //$name = mb_strtoupper($name);

    if ($children = UG::searchModel("menu.Page", ['visible_in' => ["s", "ts"], 'parent_id' => $id]))
        dropdownMenu(['parent' => $page, 'submenu' => $children], $h);
    else
    {
        echo ($id === null)
            ? "<a class='nav-link' href='" . $h . "'>$name</a>"
            : "<a class='nav-link' href='/{$h}page/id$id'>$name</a>";
        echo "</li>";
    }
}

function dropdownItem($id, $name)
{
    echo "<li><a href='/page/id$id'>$name</a></li>";
}

/**
 * @param $menu \app\models\Page[]
 * @param $first_level bool
 */
function dropdownMenu($menu, $h, $first_level = true)
{
    echo "<li class='nav-item dropdown" . ($first_level ? "" : " dropdown-submenu") . "'>";
    if ($menu['parent']->is_link)
    {
        echo "<a href='/{$h}page/id" . $menu['parent']->id . "'>" . $menu['parent']->name . "</a>";
        echo "<a class='dropdown-toggle empty' data-toggle='dropdown'><b class='caret'></b></a>";
    }
    else
        echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>"
            . $menu['parent']->name . "&emsp;<b class='caret'></b></a>";

    echo "<ul class='dropdown-menu'>";

    foreach ($menu['submenu'] as $submenu_item)
    {
        if ($children = UG::searchModel(
                "menu.Page", ['visible_in' => ["s", "ts"], 'parent_id' => $submenu_item->id])
        )
            dropdownMenu(['parent' => $submenu_item, 'submenu' => $children], $h, false);
        else
            dropdownItem($submenu_item->id, $submenu_item->name);
    }

    echo "</ul>";
    echo "</li>";
}
?>

<img src="" id="big-logo" alt="">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand"></a>

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
                tagA($page, $home);
            ?>
        </ul>
    </div>
</nav>