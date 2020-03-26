
<a href="<?=ROOT?>admin/pages/create"><i class="fa fa-plus-circle"></i></a>

<?php
/** @var $pages \app\models\crud\Page[] */

foreach ($pages as $page)
{
    echo "<div class='row text-center'>";
    echo "<div class='col-md-3'><a href='" . ROOT . "admin/pages/"
        . $page->id . "/modify'>" . $page->name . "</a></div>";
    echo "<div class='col-md-2'><a target='_blank' href='"
        . ROOT . "page/id" . $page->id . "'>Просмотреть</a></div>";
    echo "<form class='col-md-2' method='post'><button type='submit' name='id' value='"
        . $page->id . "'>Удалить</button></form>";
    echo "</div>";
}
?>