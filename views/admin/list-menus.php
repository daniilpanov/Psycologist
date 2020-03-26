
<a href="<?=ROOT?>admin/menus/create"><i class="fa fa-plus-circle"></i></a>

<?php
/** @var $menus \app\models\crud\Menu[] */

foreach ($menus as $menu)
{
    echo "<div class='row text-center'>";
    echo "<div class='col-md-3'><a href='" . ROOT . "admin/menus/"
        . $menu->id . "/modify'>" . $menu->name . "</a></div>";
    echo "<form class='col-md-2' method='post'><button type='submit' name='id' value='"
        . $menu->id . "'>Удалить</button></form>";
    echo "</div>";
}
?>