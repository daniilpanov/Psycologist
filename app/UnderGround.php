<?php


namespace app;


use app\controllers\Controller;
use app\models\Model;
use app\UnderGround\Controllers;
use app\UnderGround\ModelGroups;
use app\UnderGround\Models;

/**
 * @method Model|Model[] searchModel($name, $params = [], $only_one = false)
 * @method Model createModel($name, $params = [], $id = null, $strict_names = false)
 * @method Model createModelIfNotExists($name, $params = [])
 *
 * @method ModelGroups getGroup($name = 'default')
 * @method ModelGroups addGroup($group)
 *
 * --------------------------------------
 *
 * @method Controller getController($controller)
 * @method Controller getControllerByAbsoluteNSC($nsc)
 */
class UnderGround
{
    // 
    public static function __callStatic($name, $arguments)
    {
        return (method_exists(Models::inst(), $name)
            ? Models::inst()->$name(...$arguments)
            : Controllers::inst()->$name(...$arguments)
        );
    }
}