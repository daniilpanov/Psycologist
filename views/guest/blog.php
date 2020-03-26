<h2 class="text-center"><u><i>Блог</i></u></h2>

<?php

/** @var $blog \app\models\crud\BlogItem[]|\app\models\crud\BlogItem */

if (is_array($blog))
{
    echo "<div class='blog text-center'>";
    foreach ($blog as $blog_item)
    {
        echo "<hr><div class='blog-item'>";
        echo "<h4><a href='" . ROOT . "blog/" . $blog_item->id . "'><i>" . $blog_item->name . "</i></a></h4>";
        echo "<p>" . $blog_item->description;
        echo "</div>";
    }
    echo "</div>";
}
elseif (is_object($blog))
{
    echo "<a href='" . ROOT . "blog' class='btn btn-primary'>Назад</a>";
    echo "<h3 class='text-center'><b>" . ($blog->title ? $blog->title : $blog->name) . "</b></h3>";
    echo "<p><small>" . substr($blog->description, 0, 50) . "...</small>";
    echo "<div class='blog-content'>" . $blog->content . "</div>";
}