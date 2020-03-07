<?php
/** @var $page \app\models\Page */
$page = \app\UnderGround::searchModel("Page", ['id' => \app\App::$id]);

print($page->content);