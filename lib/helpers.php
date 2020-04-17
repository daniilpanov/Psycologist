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
        $reviews = \app\models\crud\Review::getForAdmin(null, "*", "reviews", ['page_id' => $page_id]);

    /** @var $reviews \app\models\crud\Review[] */

    $str = "<div class='reviews_animate'></div><h4 class='text-center'>ОТЗЫВЫ</h4><div class='reviews'>";

    foreach ($reviews as $review)
    {
        $str .= "<div class='review'>";

        $str .= "<p class='review_title'>" . $review->title
            . "&emsp;<small class='review_created'>{$review->getDate()}</small></p>";
        $str .= "<div class='review_content'>{$review->content}</div>";
        $str .= "<p class='review_user_name'>" . $review->user_name;

        $str .= "</div>";
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