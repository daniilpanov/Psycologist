<?php
/** @var $page \app\models\crud\Page */

$id = $page->parent_id;
$crumbs = "<li class='breadcrumb-item active'>" . $page->name . "</li>";

while ($id != '0')
{
    $crumb = \app\UnderGround::searchModel("menu.Page", ['id' => $id], true);
    $crumbs = "<li class='breadcrumb-item'><a href='" . ROOT . "page/id" . $crumb->id . "'>" . $crumb->name . "</a></li>" . $crumbs;
    $id = $crumb->parent_id;
}

echo "<nav aria-label='breadcrumbs'><ol class='breadcrumb'>$crumbs</ol></nav>";

print($page->prepared_content);