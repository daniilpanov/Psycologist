<?php
use app\App;
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?=App::$description?>">
    <meta name="keywords" content="<?=App::$keywords?>">

    <title><?=App::$title?> | Психология счастья</title>
</head>
<body>
<header>
    <?php
    include_once "views/guest/header.php";
    ?>
</header>
<main>
    <?php
    include_once "views/guest/main.php";
    ?>
</main>
<footer>
    <?php
    include_once "views/guest/footer.php";
    ?>
</footer>
</body>
</html>