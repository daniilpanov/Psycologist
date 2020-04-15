<?php
if ($_POST && isset($_POST['content']))
{
    //
    require_once "../lib/funcful.php";
    require_once "../lib/helpers.php";

    //
    spl_autoload_register(function ($namespace)
    {
        $path = "../" . str_replace("\\", DIRECTORY_SEPARATOR, $namespace) . ".php";
        if (is_file($path))
            require_once $path;
    });

    //
    $conn = include "../config/db.php";
    \app\UnderGround::createModel("Connection", $conn);


    ///
    echo app\controllers\ShortCodesController::get()->getAllCodes()->replace($_POST['content']);
}