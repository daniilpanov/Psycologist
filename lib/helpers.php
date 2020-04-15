<?php

use app\controllers\DbController;

/**
 * @return DbController|null;
 */
function db()
{
    return DbController::get();
}

/**
 * @param $page_id int|null
 * @return string|null
 */
function returnReviews($page_id)
{
    if (!$reviews = \app\UnderGround::searchModel("reviews.Review", ['page_id' => [$page_id, 0]], false))
        $reviews = \app\models\crud\Review::getAll(['page_id' => $page_id], "reviews", []);

    $str = "<div class='reviews'>";

    foreach ($reviews as $review)
    {

    }

    $str .= "</div>";

    return $str;
}

/**
 * @return string|null
 */
function returnContacts()
{

}