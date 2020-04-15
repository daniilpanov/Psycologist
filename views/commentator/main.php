<div id="content">
    <?php
    array_map(function ($view)
    {
        $view->render();
    }, \app\UnderGround::searchModel("ViewDisplay"));
    ?>
</div>