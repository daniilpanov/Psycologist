<?php
$news = \app\UnderGround::searchModel("news.BlogItem");

foreach ($news as $item)
{
    echo "<div class='news-item'>";
    echo "<h4><a href='" . ROOT . "news/id"
        . $item->id . "'>" . $item->name
        . "</a></h4>";
    echo "<p>" . $item->description;
    echo "</div>";
}