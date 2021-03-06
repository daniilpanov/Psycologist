<?php
$h = ROOT;

use app\App;
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="root-path" content="<?=$h?>">

    <link rel="stylesheet" href="<?=$h?>lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$h?>lib/bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="<?=$h?>lib/bootstrap/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="<?=$h?>lib/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?=$h?>lib/user.css">
    <link rel="stylesheet" href="<?=$h?>css/admin.css">

    <script src="<?=$h?>lib/jquery.min.js"></script>

    <script src="<?=$h?>lib/bootstrap/bootstrap.min.js"></script>
    <script src="<?=$h?>lib/bootstrap/bootstrap.bundle.min.js"></script>

    <script src="<?=$h?>lib/funcful.js"></script>
    <script src="<?=$h?>js/admin.js"></script>

    <title><?=App::$title?><!-- | Администрирование сайта--></title>
</head>
<body class="container-fluid">

<?php
if (App::$show_layout)
{
    ?>
    <header>
        <?php
        include_once "views/moderator/header.php";
        ?>
    </header>
    <main class="container">
        <?php
        include_once "views/moderator/main.php";
        ?>
    </main>
    <?php
}
else
{
    array_map(function ($view)
    {
        $view->render();
    }, \app\UnderGround::searchModel("ViewDisplay"));
}
?>

<footer>
    <?php
    include_once "views/moderator/footer.php";
    ?>
</footer>
</body>
</html>