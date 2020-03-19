<?php

use app\UnderGround as UG;

//
require_once "lib/funcful.php";
require_once "lib/helpers.php";

//
spl_autoload_register('load_class');

//
$conn = include "config/db.php";
UG::createModel("Connection", $conn)->connected;

//
/** @var $uc \app\controllers\UsersController */
$uc = \app\controllers\UsersController::get();
$uc->authorizeBySession();

//
UG::addGroup(new UG\ModelGroups("constants", "Constant"));
\app\models\Constant::aLotOfModels([], "constants");

if (is_object($h = UG::searchModel("constants.", ['name' => "root-path"], true)))
    define('ROOT', "/" . $h->value);
else
    define('ROOT', "/");

//
UG::addGroup(new UG\ModelGroups("menu"));
\app\models\Menu::aLotOfModels(
    [], "menu", [], "id, name, description, position",
    "position"
);
\app\models\Page::aLotOfModels(
    [], "menu", [], "id, name, position, visible_in, description, parent_id, menu_id, is_link"
);

//
require_once "config/routing.php";