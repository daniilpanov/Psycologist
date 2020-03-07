<?php

use app\UnderGround as UG;
use app\models\Request as R;

UG::addGroup(new \app\UnderGround\ModelGroups("routing", "Request"));
/** @var $group UG\ModelGroups */
$group = UG::getGroup('routing');

$default_controller = (
    \app\controllers\UsersController::get()->getUser()
        ? "AdminActionsController"
        : "GuestActionsController"
);

$req = (function ($type, $request, $method = null, $controller = null) use ($default_controller, $group)
{
    if (!$controller)
        $controller = $default_controller;
    $group->addModel(new \app\models\Request($type, $request, $controller, $method));
});

//
//
if (\app\controllers\UsersController::get()->getUser())
{

}
//
else
{
    $req(R::GET, ['key' => "review", 'value' => "([0-9]+)"]);
    $req(R::POST, "/login", "authorize");
    $req(R::URL, "/");
    $req(R::URL, "/page/id([0-9]+)", "page");
    $req(R::URL, "/login", "login");
}

\app\controllers\RoutingController::get()->route();