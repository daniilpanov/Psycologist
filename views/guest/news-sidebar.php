<?php

$news = \app\UnderGround::searchModel("blog.BlogItem");

foreach ($news as $item)
{
    echo "<div class='news-item'>";
    echo "<h4><a href='" . ROOT . "blog/"
        . $item->id . "'>" . $item->name
        . "</a></h4>";
    echo "<p>" . $item->description;
    echo "</div><hr>";
}