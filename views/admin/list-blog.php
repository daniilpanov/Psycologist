
<a href="<?=ROOT?>admin/news/create"><i class="fa fa-plus-circle"></i></a>

<?php
/** @var $news \app\models\crud\BlogItem[] */

foreach ($news as $news_item)
{
    echo "<div class='row text-center'>";
    echo "<div class='col-md-3'><a href='" . ROOT . "admin/blog/"
        . $news_item->id . "/modify'>" . $news_item->name . "</a></div>";
    echo "<div class='col-md-2'><a target='_blank' href='"
        . ROOT . "blog/" . $news_item->id . "'>Просмотреть</a></div>";
    echo "<form class='col-md-2' method='post'><button type='submit' name='id' value='"
        . $news_item->id . "'>Удалить</button></form>";
    echo "</div>";
}
?>