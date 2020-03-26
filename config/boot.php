<?php

use app\UnderGround as UG;

session_set_cookie_params(5184000);
session_start();

//
require_once "lib/funcful.php";
require_once "lib/helpers.php";

//
spl_autoload_register('load_class');

//
$conn = include "config/db.php";
UG::createModel("Connection", $conn);

//
/** @var $uc \app\controllers\UsersController */
$uc = \app\controllers\UsersController::get();
$uc->authorizeBySession();

//
//
UG::addGroup(new UG\ModelGroups("constants", "Constant"));
\app\models\crud\Constant::getAll([], "constants");

//
if (is_object($h = UG::searchModel("constants.", ['name' => "root-path"], true)))
    define('ROOT', "/" . $h->value);
else
    define('ROOT', "/");

//
require_once "config/routing.php";