<div id="control">
    <button class="btn btn-danger" id="sidebar-close">&times;</button>
    <button class="btn btn-info" id="sidebar-open">&xrArr;</button>
</div>

<div id="sidebar" class="offset-md-1 col-md-2">
    <?php
    (new \app\models\ViewDisplay("guest/sidebar"))->render()
    ?>
</div>

<div id="content" class="col-md-6">
    <?php
    array_map(function ($view)
    {
        $view->render();
    }, \app\UnderGround::searchModel("ViewDisplay"));
    ?>
</div>
<?php
if (strpos(getUrl()['path'], "blog") === false) {
    ?>
    <div id="news-control">
        <button class="btn btn-danger" id="news-close">&times;</button>
        <button class="btn btn-info" id="news-open">&xlArr;</button>
    </div>

    <div id="news" class="nshow">
        <p class="text-center">
        <h3><a href="<?= ROOT ?>blog">Блог</a></h3></p>
        <?php
        require_once "views/guest/news-sidebar.php";
        ?>
    </div>
    <?php
}
?>