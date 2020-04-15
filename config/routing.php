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
$req($gac, R::URL, "/page/id([0-9]+)/?", "page");
$req($gac, R::URL, "/blog/?([0-9]+)?", "blog");
//
if ($user = \app\controllers\UsersController::get()->getUser())
{
    // Just actions
    $req($aac, R::URL, "/admin/?");
    $req($aac, R::POST, "/admin/?", "logout");
    // REVIEWS
    $req($aac, R::URL, "/admin/reviews/?", "reviews");
    $req($aac, R::URL, "/admin/reviews/create/?", "createEditReview");
    $req($aac, R::URL, "/admin/reviews/([0-9]+)/modify/?", "createEditReview");
    $req($aac, R::POST, "/admin/reviews/create/?", "createEditReviewToServer");
    $req($aac, R::POST, "/admin/reviews/([0-9]+)/modify/?", "createEditReviewToServer");
    $req($aac, R::POST, "/admin/reviews/?", "deleteReview");

    if ($user->role != "commentator")
    {
        if ($user->role == "admin")
        {
            /////////
            /// CRUD
            ////////
            // PAGES
            $req($aac, R::URL, "/admin/pages/?", "pages");
            $req($aac, R::URL, "/admin/pages/create/?", "createEditPage");
            $req($aac, R::URL, "/admin/pages/([0-9]+)/modify/?", "createEditPage");
            $req($aac, R::POST, "/admin/pages/create/?", "createEditPageToServer");
            $req($aac, R::POST, "/admin/pages/([0-9]+)/modify/?", "createEditPageToServer");
            $req($aac, R::POST, "/admin/pages/?", "deletePage");
            // MENUS
            $req($aac, R::URL, "/admin/menus/?", "menus");
            $req($aac, R::URL, "/admin/menus/create/?", "createEditMenu");
            $req($aac, R::URL, "/admin/menus/([0-9]+)/modify/?", "createEditMenu");
            $req($aac, R::POST, "/admin/menus/create/?", "createEditMenuToServer");
            $req($aac, R::POST, "/admin/menus/([0-9]+)/modify/?", "createEditMenuToServer");
            $req($aac, R::POST, "/admin/menus/?", "deleteMenu");
            // SECTIONS
            //$req($aac, R::URL, "/admin/sections/?", "sections");
            // NEWS
            $req($aac, R::URL, "/admin/blog/?", "blog");
            $req($aac, R::URL, "/admin/blog/create/?", "createEditBlogItem");
            $req($aac, R::URL, "/admin/blog/([0-9]+)/modify/?", "createEditBlogItem");
            $req($aac, R::POST, "/admin/blog/create/?", "createEditBlogItemToServer");
            $req($aac, R::POST, "/admin/blog/([0-9]+)/modify/?", "createEditBlogItemToServer");
            $req($aac, R::POST, "/admin/blog/?", "deleteBlogItem");
            // SHORT_CODES
            $req($aac, R::URL, "/admin/short_codes/?", "shortCodes");
            $req($aac, R::URL, "/admin/short_codes/create/?", "createEditShortCode");
            $req($aac, R::URL, "/admin/short_codes/([0-9]+)/modify/?", "createEditShortCode");
            $req($aac, R::POST, "/admin/short_codes/create/?", "createEditShortCodeToServer");
            $req($aac, R::POST, "/admin/short_codes/([0-9]+)/modify/?", "createEditShortCodeToServer");
            $req($aac, R::POST, "/admin/short_codes/?", "deleteShortCode");
            // USERS
            $req($aac, R::URL, "/admin/users/?", "users");
            $req($aac, R::URL, "/admin/users/create/?", "createEditUser");
            $req($aac, R::URL, "/admin/users/([0-9]+)/modify/?", "createEditUser");
            $req($aac, R::POST, "/admin/users/create/?", "createUserToServer");
            $req($aac, R::POST, "/admin/users/([0-9]+)/modify/?", "editUserToServer");
            $req($aac, R::POST, "/admin/users/?", "deleteUser");
            // CONSTANTS
            $req($aac, R::URL, "/admin/constants/?", "constants");
            $req($aac, R::URL, "/admin/constants/create/?", "createEditConstant");
            $req($aac, R::URL, "/admin/constants/([0-9]+)/modify/?", "createEditConstant");
            $req($aac, R::POST, "/admin/constants/create/?", "createEditConstantToServer");
            $req($aac, R::POST, "/admin/constants/([0-9]+)/modify/?", "createEditConstantToServer");
            $req($aac, R::POST, "/admin/constants/?", "deleteConstant");
        }
        else
        {
            $req($aac, R::URL, "/admin/users/(" . \app\controllers\UsersController::get()->getUser()->id
                . ")/modify/?", "createEditUser");
            $req($aac, R::POST, "/admin/users/(" . \app\controllers\UsersController::get()->getUser()->id
                . ")/modify/?", "editUserToServer");
        }
    }
    else
    {
        $req($aac, R::URL, "/admin/users/(" . \app\controllers\UsersController::get()->getUser()->id
            . ")/modify/?", "createEditUser");
        $req($aac, R::POST, "/admin/users/(" . \app\controllers\UsersController::get()->getUser()->id
            . ")/modify/?", "editUserToServer");
    }
}
//
else
{
    $req($gac, R::POST, "/login/?", "auth");
    $req($gac, R::POST, "/", "auth");
    $req($gac, R::POST, "/reg/?", "register");

    $req($gac, R::URL, "/login/?", "login");
    $req($gac, R::URL, "/reg/?", "registration");
}

\app\controllers\RoutingController::get()->route();