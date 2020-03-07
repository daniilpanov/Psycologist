<?php

use app\controllers\DbController;

/**
 * @return DbController|null;
 */
function db()
{
    return DbController::get();
}