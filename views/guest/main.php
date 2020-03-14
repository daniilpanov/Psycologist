<div id="control">
    <button class="btn btn-danger" id="sidebar-close">&times;</button>
    <button class="btn btn-info" id="sidebar-open">&xrArr;</button>
</div>

<div class="col-md-1">
</div>

<div id="sidebar" class="col-md-4">
    <?php
    (new \app\models\ViewDisplay("guest/sidebar"))->render()
    ?>
</div>

<div id="content" class="col-md-7">
    <?php
    array_map(function ($view)
    {
        $view->render();
    }, \app\UnderGround::searchModel("ViewDisplay"));
    ?>
</div>