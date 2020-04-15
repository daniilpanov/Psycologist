
<a href="<?= ROOT ?>admin/reviews/create"><i class="fa fa-plus-circle"></i></a>

<?php

/** @var $reviews \app\models\crud\Review[] */

if ($reviews && is_array($reviews))
{
    foreach ($reviews as $review)
    {
        echo "<div class='row'>";
        echo "<div class='col-md-3'>" . $review->title . "</div>";
        echo "<div class='col-md-1'>" . $review->rating . "</div>";
        echo "<div class='col-md-3'>" . $review->user_name . "</div>";
        echo "<div class='col-md-3'>"
            . ($review->page_name ? $review->page_name : "Без привязки к странице") . "</div>";
        echo "<div class='col-md-1'><a href='" . ROOT . "admin/reviews/"
            . $review->id . "/modify'><i class='fa fa-pencil'></i></a></div>";
        echo "<form method='post' class='col-md-1'><button name='id' value='"
            . $review->id . "'><i class='fa fa-trash'></i></button></form>";
        echo "</div>";
    }
}