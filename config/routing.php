<?php

use app\UnderGround as UG;
use app\models\Request as R;

UG::addGroup(new \app\UnderGround\ModelGroups("routing", "Request"));
/** @var $group UG\ModelGroups */
$group = UG::getGroup('routing');

$aac = "AdminActionsController";
$gac = "GuestActionsController";

$req = (function ($controller, $type, $request, $method = null) use ($group)
{
    $group->addModel(new \app\models\Request($type, $request, $controller, $method));
});

//
$req($gac, R::GET, ['key' => "review", 'value' => "([0-9]+)"]);
$req($gac, R::URL, "/");
$req($gac, R::URL, "/page/id([0-9]+)", "page");
//
if (\app\controllers\UsersController::get()->getUser())
{
    $req($aac, R::URL, "/admin");
    $req($aac, R::POST, "/admin", "logout");
}
//
else
{
    $req($gac, R::POST, "/login", "auth");
    $req($gac, R::POST, "/", "auth");
    $req($gac, R::POST, "/reg", "register");

    $req($gac, R::URL, "/login", "login");
    $req($gac, R::URL, "/reg", "registration");
}

\app\controllers\RoutingController::get()->route();