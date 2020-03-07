<?php

use app\UnderGround as UG;

require_once "lib/funcful.php";
require_once "lib/helpers.php";

spl_autoload_register('load_class');

$conn = include "config/db.php";
UG::createModel("Connection", $conn);

/** @var $uc \app\controllers\UsersController */
$uc = \app\controllers\UsersController::get();

$uc->authorizeBySession();

UG::createModel("constants.Constant", ['root-path'], null, true);

require_once "config/routing.php";